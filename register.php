<?php 
session_start();
require_once 'config/db.php';

$page_title = "Đăng ký tài khoản";
$base_url = "./";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Default role: Sales (3) and Status: Active
    $role_id = 3; 
    $status = 'active';

    // Validate Password
    // Regex: Ít nhất 8 ký tự, 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    if (!preg_match($password_pattern, $password)) {
        $error = "Mật khẩu không đủ mạnh! (Yêu cầu: Tối thiểu 8 ký tự, bao gồm chữ hoa, thường, số và ký tự đặc biệt)";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        // Check if username or email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Tên đăng nhập hoặc Email đã tồn tại!";
        } else {
            // Handle Avatar Upload
            $avatar = 'default-avatar.png'; // Default
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $target_dir = "assets/uploads/avatars/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
                $new_filename = $username . "_" . time() . "." . $file_extension;
                $target_file = $target_dir . $new_filename;
                
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $avatar = $new_filename;
                }
            }

            // Hash Password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert User
            $stmt = $conn->prepare("INSERT INTO users (role_id, username, password, full_name, email, phone, avatar, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssss", $role_id, $username, $hashed_password, $full_name, $email, $phone, $avatar, $status);
            
            if ($stmt->execute()) {
                $success = "Đăng ký thành công! Bạn có thể đăng nhập ngay bây giờ.";
            } else {
                $error = "Lỗi hệ thống: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?> - PhoneStore Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>
<body style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px 0;">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        
        <div style="background: var(--white); border-radius: var(--radius-xl); padding: 36px; border: 2px solid var(--border);">
          
          <div style="text-align: center; margin-bottom: 24px;">
            <h1 style="font-size: 1.6rem; font-weight: 700; color: var(--dark);">Đăng ký tài khoản</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Tham gia hệ thống quản lý PhoneStore</p>
          </div>

          <?php if($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php endif; ?>

          <?php if($success): ?>
            <div class="alert alert-success">
                <?php echo $success; ?> 
                <a href="login.php" style="margin-left: 10px; text-decoration: underline;">Đăng nhập ngay</a>
            </div>
          <?php endif; ?>

          <form action="register.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
              <label>Họ và tên</label>
              <input type="text" name="full_name" class="form-control" required placeholder="Nguyễn Văn A">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control" required placeholder="username">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" placeholder="09xxxx">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required placeholder="email@example.com">
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="reg_password" class="form-control" required style="padding-right: 40px;" placeholder="VD: P@ssw0rd123 (Hoa, thường, số, đặc biệt)">
                    <i class="bi bi-eye-slash" onclick="togglePass('reg_password', this)" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--text-muted);"></i>
                </div>
                <!-- Password Hint Helper -->
                <small class="form-text text-muted" style="font-size: 0.75rem; display: block; margin-top: 5px; line-height: 1.3; color: var(--secondary);">
                    * Yêu cầu: Tối thiểu 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.
                </small>
            </div>

            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <div style="position: relative;">
                    <input type="password" name="confirm_password" id="reg_confirm" class="form-control" required style="padding-right: 40px;" placeholder="Nhập lại mật khẩu bên trên">
                    <i class="bi bi-eye-slash" onclick="togglePass('reg_confirm', this)" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--text-muted);"></i>
                </div>
            </div>

            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="file" name="avatar" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 1rem; margin-top: 10px;">
              <i class="bi bi-person-plus"></i> Đăng ký
            </button>

          </form>

          <div style="margin-top: 24px; text-align: center; border-top: 2px solid var(--light); padding-top: 20px;">
            <p style="font-size: 0.9rem; color: var(--text-muted);">
              Đã có tài khoản? <a href="login.php" style="color: var(--primary); font-weight: 700; text-decoration: none;">Đăng nhập</a>
            </p>
          </div>

        </div>

        <p style="text-align: center; margin-top: 24px; color: rgba(255,255,255,0.9); font-size: 0.9rem;">
          &copy; 2024 PhoneStore Management System
        </p>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function togglePass(inputId, icon) {
        const input = document.getElementById(inputId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    }
  </script>
</body>
</html>
