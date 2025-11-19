<?php 
session_start();
require_once 'config/db.php';

$page_title = "Đăng ký tài khoản";
$base_url = "./";
$errors = []; // Mảng lưu lỗi
$system_error = ""; // Lỗi hệ thống chung
$success = "";

// Khởi tạo biến để giữ lại dữ liệu cũ
$full_name = $username = $email = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Default role: Sales (3) and Status: Active
    $role_id = 3; 
    $status = 'active';

    // Validate Password
    // Regex: Ít nhất 8 ký tự, 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    if (empty($full_name)) $errors['full_name'] = "Vui lòng nhập họ và tên.";
    if (empty($username)) $errors['username'] = "Vui lòng nhập tên đăng nhập.";
    if (empty($email)) $errors['email'] = "Vui lòng nhập email.";
    
    if (!preg_match($password_pattern, $password)) {
        $errors['password'] = "Mật khẩu quá yếu (Cần 8 ký tự, Hoa, thường, số, đặc biệt).";
    }
    
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Mật khẩu xác nhận không khớp.";
    }

    // Chỉ kiểm tra DB nếu chưa có lỗi cơ bản
    if (empty($errors)) {
        // Check if username or email exists
        $stmt = $conn->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Xác định cụ thể cái nào trùng
            while($row = $result->fetch_assoc()) {
                if ($row['username'] === $username) $errors['username'] = "Tên đăng nhập này đã được sử dụng.";
                if ($row['email'] === $email) $errors['email'] = "Email này đã được đăng ký.";
            }
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
                $system_error = "Lỗi hệ thống: " . $conn->error;
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

          <?php if($system_error): ?>
            <div class="alert alert-danger"><?php echo $system_error; ?></div>
          <?php endif; ?>

          <?php if($success): ?>
            <div class="alert alert-success">
                <?php echo $success; ?> 
                <a href="login.php" style="margin-left: 10px; text-decoration: underline;">Đăng nhập ngay</a>
            </div>
          <?php endif; ?>

          <form action="register.php" method="post" enctype="multipart/form-data" novalidate>
            
            <div class="form-group">
              <label>Họ và tên <span class="text-danger">*</span></label>
              <input type="text" name="full_name" class="form-control <?php echo isset($errors['full_name']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($full_name); ?>" required placeholder="Nguyễn Văn A">
              <?php if(isset($errors['full_name'])): ?>
                <div class="invalid-feedback"><?php echo $errors['full_name']; ?></div>
              <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên đăng nhập <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>" required placeholder="username">
                        <?php if(isset($errors['username'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['username']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" placeholder="09xxxx">
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>" required placeholder="email@example.com">
              <?php if(isset($errors['email'])): ?>
                <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
              <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Mật khẩu <span class="text-danger">*</span></label>
                <div style="position: relative;">
                    <input type="password" name="password" id="reg_password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" required style="padding-right: 40px; background-image: none;" placeholder="VD: P@ssw0rd123 (Hoa, thường, số, đặc biệt)">
                    <i class="bi bi-eye-slash" onclick="togglePass('reg_password', this)" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--text-muted);"></i>
                </div>
                <?php if(isset($errors['password'])): ?>
                    <div class="invalid-feedback" style="display:block;"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
                <!-- Password Hint Helper -->
                <ul class="list-unstyled mt-2 mb-0" style="font-size: 0.75rem; color: var(--secondary);">
                    <li id="rule-length"><i class="bi bi-x-circle"></i> Tối thiểu 8 ký tự</li>
                    <li id="rule-upper"><i class="bi bi-x-circle"></i> Chữ cái viết hoa (A-Z)</li>
                    <li id="rule-lower"><i class="bi bi-x-circle"></i> Chữ cái thường (a-z)</li>
                    <li id="rule-number"><i class="bi bi-x-circle"></i> Số (0-9)</li>
                    <li id="rule-special"><i class="bi bi-x-circle"></i> Ký tự đặc biệt (!@#$...)</li>
                </ul>
            </div>

            <div class="form-group">
                <label>Nhập lại mật khẩu <span class="text-danger">*</span></label>
                <div style="position: relative;">
                    <input type="password" name="confirm_password" id="reg_confirm" class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" required style="padding-right: 40px; background-image: none;" placeholder="Nhập lại mật khẩu bên trên">
                    <i class="bi bi-eye-slash" onclick="togglePass('reg_confirm', this)" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--text-muted);"></i>
                </div>
                <?php if(isset($errors['confirm_password'])): ?>
                    <div class="invalid-feedback" style="display:block;"><?php echo $errors['confirm_password']; ?></div>
                <?php endif; ?>
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

    document.addEventListener('DOMContentLoaded', function() {
        // 1. XÓA TRẠNG THÁI LỖI KHI NGƯỜI DÙNG NHẬP LIỆU
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                // Xóa viền đỏ
                this.classList.remove('is-invalid');
                
                // Tìm và ẩn div thông báo lỗi (nằm trong cùng form-group)
                const formGroup = this.closest('.form-group');
                const errorMsg = formGroup.querySelector('.invalid-feedback');
                if (errorMsg) {
                    errorMsg.style.display = 'none';
                }
            });
        });

        // 2. CHECK MẬT KHẨU REAL-TIME
        const passwordInput = document.getElementById('reg_password');
        
        // Các quy tắc
        const rules = {
            'rule-length': /.{8,}/,
            'rule-upper': /[A-Z]/,
            'rule-lower': /[a-z]/,
            'rule-number': /[0-9]/,
            'rule-special': /[\W_]/
        };

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            
            for (const [id, regex] of Object.entries(rules)) {
                const element = document.getElementById(id);
                const icon = element.querySelector('i');

                if (regex.test(val)) {
                    // Đạt yêu cầu: Màu xanh, icon check
                    element.classList.remove('text-danger');
                    element.classList.add('text-success');
                    icon.classList.remove('bi-x-circle');
                    icon.classList.add('bi-check-circle-fill');
                } else {
                    // Chưa đạt: Màu đỏ/xám, icon x
                    element.classList.remove('text-success');
                    // Chỉ hiện màu đỏ nếu đã nhập gì đó, nếu trống thì để màu mặc định
                    if(val.length > 0) {
                        element.classList.add('text-danger');
                    } else {
                        element.classList.remove('text-danger');
                    }
                    icon.classList.remove('bi-check-circle-fill');
                    icon.classList.add('bi-x-circle');
                }
            }
        });

        // Check khớp mật khẩu real-time
        const confirmInput = document.getElementById('reg_confirm');
        confirmInput.addEventListener('input', function() {
            if(this.value !== '' && this.value !== passwordInput.value) {
                this.classList.add('is-invalid');
            }
        });
    });
  </script>
</body>
</html>
