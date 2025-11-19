<?php
session_start();
require_once '../config/db.php';
require_once '../config/google_config.php';

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        
        // Lấy thông tin từ Google
        $google_id = $google_account_info->id;
        $email = $google_account_info->email;
        $full_name = $google_account_info->name;
        $avatar = $google_account_info->picture;
        
        // Kiểm tra xem user đã tồn tại chưa (theo email hoặc google_id)
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR google_id = ?");
        $stmt->bind_param("ss", $email, $google_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // User đã tồn tại
            $user = $result->fetch_assoc();
            
            // Nếu chưa có google_id thì cập nhật
            if (empty($user['google_id'])) {
                $update = $conn->prepare("UPDATE users SET google_id = ?, avatar = ? WHERE id = ?");
                $update->bind_param("ssi", $google_id, $avatar, $user['id']);
                $update->execute();
            }
            
            // Kiểm tra trạng thái hoặc chưa có mật khẩu
            if ($user['status'] === 'inactive' || empty($user['password'])) {
                $_SESSION['temp_user_id'] = $user['id'];
                $_SESSION['temp_email'] = $email;
                header("Location: setup_password.php");
                exit;
            }
            
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['avatar'] = $user['avatar'];
            header("Location: ../index.php");
            exit;
            
        } else {
            // User chưa tồn tại -> Tạo mới với status = inactive
            $role_id = 3; // Mặc định là khách hàng/sales
            $status = 'inactive';
            
            // Username tạm thời bằng google_id để tránh lỗi Unique, sẽ đổi ở bước setup
            $temp_username = "google_" . $google_id;
            
            $stmt = $conn->prepare("INSERT INTO users (role_id, username, full_name, email, avatar, google_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $role_id, $temp_username, $full_name, $email, $avatar, $google_id, $status);
            
            if ($stmt->execute()) {
                $new_user_id = $conn->insert_id;
                $_SESSION['temp_user_id'] = $new_user_id;
                $_SESSION['temp_email'] = $email;
                header("Location: setup_password.php");
                exit;
            } else {
                die("Lỗi hệ thống: " . $conn->error);
            }
        }
    } else {
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
