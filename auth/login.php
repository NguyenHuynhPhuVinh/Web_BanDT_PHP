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
<body class="auth-body">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        
        <!-- Login Card -->
        <div class="auth-card">
          
          <?php include '../components/auth_logo.php'; ?>

          <?php if(isset($errors['common'])): ?>
            <div class="alert alert-danger py-2 fs-6"><?php echo $errors['common']; ?></div>
          <?php endif; ?>

          <!-- Login Form -->
          <form action="login.php" method="post" novalidate>
            
            <div class="form-group mb-3">
              <label for="username" class="mb-2 small">Tên đăng nhập</label>
              <div class="input-wrapper">
                <input type="text" id="username" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" placeholder="admin hoặc sales01" required value="<?php echo htmlspecialchars($username); ?>">
                <i class="bi bi-person input-icon left"></i>
              </div>
              <?php if(isset($errors['username'])): ?>
                  <div class="invalid-feedback d-block"><?php echo $errors['username']; ?></div>
              <?php endif; ?>
            </div>

            <div class="form-group mb-4">
              <label for="password" class="mb-2 small">Mật khẩu</label>
              <div class="input-wrapper">
                <input type="password" id="password" name="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" placeholder="123456" required style="padding-right: 40px; background-image: none;">
                <i class="bi bi-lock input-icon left"></i>
                <i class="bi bi-eye-slash input-icon right" id="togglePassword"></i>
              </div>
              <?php if(isset($errors['password'])): ?>
                  <div class="invalid-feedback d-block"><?php echo $errors['password']; ?></div>
              <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary auth-btn">
              <i class="bi bi-box-arrow-in-right fs-5"></i>
              <span>Đăng nhập</span>
            </button>
          </form>

          <div class="auth-link-box">
            <p class="text-muted small m-0">
              Chưa có tài khoản? <a href="register.php" class="text-primary fw-bold text-decoration-none">Đăng ký ngay</a>
            </p>
          </div>
        </div>

        <?php include '../components/auth_footer.php'; ?>

      </div>
    </div>
  </div>
</body>
</html>
