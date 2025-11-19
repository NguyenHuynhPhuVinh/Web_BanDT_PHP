<?php
session_start();
require_once '../config/db.php';

// Kiểm tra xem có phải đang trong luồng Google Login không
if (!isset($_SESSION['temp_user_id'])) {
    header("Location: login.php");
    exit;
}

$page_title = "Thiết lập tài khoản";
$base_url = "../";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_SESSION['temp_user_id'];
    
    // Validate
    if (empty($username)) $errors['username'] = "Vui lòng nhập tên đăng nhập.";
    
    // Check username exist (trừ chính user này)
    $check = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
    $check->bind_param("si", $username, $user_id);
    $check->execute();
    if ($check->get_result()->num_rows > 0) {
        $errors['username'] = "Tên đăng nhập đã tồn tại.";
    }
    
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (!preg_match($password_pattern, $password)) {
        $errors['password'] = "Mật khẩu quá yếu (Cần 8 ký tự, Hoa, thường, số, đặc biệt).";
    }
    
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Mật khẩu xác nhận không khớp.";
    }
    
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = 'active';
        
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $hashed_password, $status, $user_id);
        
        if ($stmt->execute()) {
            // Lấy thông tin user để set session chính thức
            $get_user = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $get_user->bind_param("i", $user_id);
            $get_user->execute();
            $user_info = $get_user->get_result()->fetch_assoc();
            
            $_SESSION['user_id'] = $user_info['id'];
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['full_name'] = $user_info['full_name'];
            $_SESSION['role_id'] = $user_info['role_id'];
            $_SESSION['avatar'] = $user_info['avatar'];
            
            // Xóa session tạm
            unset($_SESSION['temp_user_id']);
            unset($_SESSION['temp_email']);
            
            header("Location: ../index.php");
            exit;
        } else {
            $errors['common'] = "Lỗi cập nhật: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <?php include '../components/auth_head.php'; ?>
</head>
<body class="auth-body">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        
        <div class="auth-card">
          
          <div class="auth-header">
            <h3 class="fw-bold">Hoàn tất đăng ký</h3>
            <p class="text-muted small">Vui lòng thiết lập mật khẩu cho tài khoản Google: <br><strong><?php echo $_SESSION['temp_email']; ?></strong></p>
          </div>

          <?php if(isset($errors['common'])): ?>
            <div class="alert alert-danger"><?php echo $errors['common']; ?></div>
          <?php endif; ?>

          <form method="post">
            
            <div class="form-group mb-3">
              <label>Tên đăng nhập mong muốn</label>
              <input type="text" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" required placeholder="username">
              <?php if(isset($errors['username'])): ?>
                <div class="invalid-feedback"><?php echo $errors['username']; ?></div>
              <?php endif; ?>
            </div>

            <div class="form-group mb-3">
              <label>Mật khẩu mới</label>
              <input type="password" name="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" required placeholder="********">
              <?php if(isset($errors['password'])): ?>
                <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
              <?php endif; ?>
            </div>

            <div class="form-group mb-4">
              <label>Xác nhận mật khẩu</label>
              <input type="password" name="confirm_password" class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" required placeholder="********">
              <?php if(isset($errors['confirm_password'])): ?>
                <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
              <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary auth-btn">Kích hoạt tài khoản</button>
          </form>

        </div>

      </div>
    </div>
  </div>

</body>
</html>
