<?php 
session_start();
require_once 'config/db.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$page_title = "Đăng nhập";
$base_url = "./";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check user in DB
    $stmt = $conn->prepare("SELECT id, username, password, full_name, role_id, avatar FROM users WHERE username = ? AND status = 'active'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password correct, start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['avatar'] = $user['avatar'];
            
            header("Location: index.php");
            exit;
        } else {
            $error = "Mật khẩu không chính xác.";
        }
    } else {
        $error = "Tên đăng nhập không tồn tại hoặc tài khoản bị khóa.";
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
<body style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        
        <!-- Login Card -->
        <div style="background: var(--white); border-radius: var(--radius-xl); padding: 36px; border: 2px solid var(--border);">
          
          <!-- Logo & Title -->
          <div style="text-align: center; margin-bottom: 28px;">
            <div style="width: 70px; height: 70px; background: var(--primary); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 2.2rem; color: white;">
              <i class="bi bi-phone"></i>
            </div>
            <h1 style="font-size: 1.6rem; font-weight: 700; color: var(--dark); margin-bottom: 6px;">PhoneStore</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem; font-weight: 500;">Hệ thống quản lý cửa hàng</p>
          </div>

          <?php if($error): ?>
            <div class="alert alert-danger" style="font-size: 0.9rem; padding: 10px;"><?php echo $error; ?></div>
          <?php endif; ?>

          <!-- Login Form -->
          <form action="login.php" method="post">
            
            <!-- Username -->
            <div class="form-group" style="margin-bottom: 18px;">
              <label for="username" style="margin-bottom: 8px; font-size: 0.85rem;">Tên đăng nhập</label>
              <div style="position: relative;">
                <input 
                  type="text" 
                  id="username" 
                  name="username" 
                  class="form-control" 
                  placeholder="admin hoặc sales01"
                  required
                  style="padding-left: 42px;"
                >
                <i class="bi bi-person" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem;"></i>
              </div>
            </div>

            <!-- Password -->
            <div class="form-group" style="margin-bottom: 18px;">
              <label for="password" style="margin-bottom: 8px; font-size: 0.85rem;">Mật khẩu</label>
              <div style="position: relative;">
                <input 
                  type="password" 
                  id="password" 
                  name="password" 
                  class="form-control" 
                  placeholder="123456"
                  required
                  style="padding-left: 42px;"
                >
                <i class="bi bi-lock" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem;"></i>
              </div>
            </div>

            <!-- Remember Me & Forgot -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
              <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin: 0;">
                <input type="checkbox" name="remember" style="width: 16px; height: 16px; cursor: pointer;">
                <span style="font-size: 0.85rem; color: var(--dark); font-weight: 500;">Ghi nhớ</span>
              </label>
              <a href="#" style="font-size: 0.85rem; color: var(--primary); text-decoration: none; font-weight: 600;">Quên mật khẩu?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px 24px; font-size: 0.95rem; font-weight: 700;">
              <i class="bi bi-box-arrow-in-right" style="font-size: 1.1rem;"></i>
              <span>Đăng nhập</span>
            </button>

          </form>

          <div style="margin-top: 24px; padding-top: 20px; border-top: 2px solid var(--light); text-align: center;">
            <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">
              Chưa có tài khoản? 
              <a href="register.php" style="color: var(--primary); font-weight: 700; text-decoration: none;">Đăng ký ngay</a>
            </p>
          </div>

        </div>

        <!-- Footer -->
        <p style="text-align: center; margin-top: 24px; color: rgba(255,255,255,0.9); font-size: 0.9rem; font-weight: 500;">
          &copy; 2024 PhoneStore Management System
        </p>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
