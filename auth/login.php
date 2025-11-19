<?php 
session_start();
require_once '../config/db.php'; // Adjusted path

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Adjusted path
    exit;
}

$page_title = "Đăng nhập";
$base_url = "../"; // Adjusted base url for assets
$errors = []; 
$username = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate Inputs
    if (empty($username)) $errors['username'] = "Vui lòng nhập tên đăng nhập.";
    if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, username, password, full_name, role_id, avatar FROM users WHERE username = ? AND status = 'active'");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role_id'] = $user['role_id'];
                $_SESSION['avatar'] = $user['avatar'];
                header("Location: ../index.php"); // Adjusted path
                exit;
            } else {
                $errors['common'] = "Tên đăng nhập hoặc mật khẩu không chính xác.";
            }
        } else {
            $errors['common'] = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <?php include '../components/auth_head.php'; ?>
</head>
<body style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        
        <!-- Login Card -->
        <div style="background: var(--white); border-radius: var(--radius-xl); padding: 36px; border: 2px solid var(--border);">
          
          <?php include '../components/auth_logo.php'; ?>

          <?php if(isset($errors['common'])): ?>
            <div class="alert alert-danger" style="font-size: 0.9rem; padding: 10px;"><?php echo $errors['common']; ?></div>
          <?php endif; ?>

          <!-- Login Form -->
          <form action="login.php" method="post" novalidate>
            
            <div class="form-group" style="margin-bottom: 18px;">
              <label for="username" style="margin-bottom: 8px; font-size: 0.85rem;">Tên đăng nhập</label>
              <div style="position: relative;">
                <input type="text" id="username" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" placeholder="admin hoặc sales01" required style="padding-left: 42px;" value="<?php echo htmlspecialchars($username); ?>">
                <i class="bi bi-person" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem;"></i>
                <?php if(isset($errors['username'])): ?>
                    <div class="invalid-feedback" style="position: absolute; bottom: -22px; left: 0;"><?php echo $errors['username']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
              <label for="password" style="margin-bottom: 8px; font-size: 0.85rem;">Mật khẩu</label>
              <div style="position: relative;">
                <input type="password" id="password" name="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" placeholder="123456" required style="padding-left: 42px; padding-right: 40px; background-image: none;">
                <i class="bi bi-lock" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem;"></i>
                <i class="bi bi-eye-slash" id="togglePassword" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--text-muted); font-size: 1.1rem;"></i>
                <?php if(isset($errors['password'])): ?>
                    <div class="invalid-feedback" style="position: absolute; bottom: -22px; left: 0;"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
              </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px 24px; font-size: 0.95rem; font-weight: 700;">
              <i class="bi bi-box-arrow-in-right" style="font-size: 1.1rem;"></i>
              <span>Đăng nhập</span>
            </button>
          </form>

          <div style="margin-top: 24px; padding-top: 20px; border-top: 2px solid var(--light); text-align: center;">
            <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">
              Chưa có tài khoản? <a href="register.php" style="color: var(--primary); font-weight: 700; text-decoration: none;">Đăng ký ngay</a>
            </p>
          </div>
        </div>

        <?php include '../components/auth_footer.php'; ?>

      </div>
    </div>
  </div>
</body>
</html>
