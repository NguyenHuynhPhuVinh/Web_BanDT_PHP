<?php 
$page_title = "Quản lý người dùng";
$current_page = "users";
$base_url = "../";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <?php include '../components/head.php'; ?>
</head>
<body>
  <div class="wrapper">
    <?php include '../components/sidebar.php'; ?>

    <div class="main-content">
      <?php include '../components/header.php'; ?>

      <div class="content">
        <div class="page-title">
          <h1>Quản lý người dùng</h1>
          <div class="breadcrumb">Trang chủ / Người dùng</div>
        </div>

        <!-- Stats -->
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon blue">
                <i class="bi bi-people"></i>
              </div>
              <div class="stat-info">
                <h4>Tổng người dùng</h4>
                <div class="stat-value">24</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon green">
                <i class="bi bi-person-check"></i>
              </div>
              <div class="stat-info">
                <h4>Đang hoạt động</h4>
                <div class="stat-value">20</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon orange">
                <i class="bi bi-shield-check"></i>
              </div>
              <div class="stat-info">
                <h4>Quản trị viên</h4>
                <div class="stat-value">3</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon red">
                <i class="bi bi-person-x"></i>
              </div>
              <div class="stat-info">
                <h4>Không hoạt động</h4>
                <div class="stat-value">4</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter -->
        <div class="filter-bar">
          <div class="filter-row">
            <div class="filter-group">
              <label>Vai trò</label>
              <select class="form-control">
                <option>Tất cả</option>
                <option>Admin</option>
                <option>Manager</option>
                <option>Sales</option>
                <option>Warehouse</option>
              </select>
            </div>
            <div class="filter-group">
              <label>Trạng thái</label>
              <select class="form-control">
                <option>Tất cả</option>
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
            <div class="filter-group action">
              <label>&nbsp;</label>
              <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm người dùng
              </button>
            </div>
          </div>
        </div>

        <!-- Users Table -->
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>#1</strong></td>
                    <td><strong>admin</strong></td>
                    <td>Toàn Diện</td>
                    <td><small class="text-muted">admin@email.com</small></td>
                    <td>0912345678</td>
                    <td><span class="badge badge-danger">Admin</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>01/01/2024</td>
                    <td class="td-actions">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>#2</strong></td>
                    <td><strong>sales01</strong></td>
                    <td>Bình Minh</td>
                    <td><small class="text-muted">sales@email.com</small></td>
                    <td>0901234567</td>
                    <td><span class="badge badge-primary">Sales</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>20/03/2024</td>
                    <td class="td-actions">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                      <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="pagination">
          <button><i class="bi bi-chevron-left"></i></button>
          <button class="active">1</button>
          <button>2</button>
          <button><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>

      <?php include '../components/footer.php'; ?>
    </div>
  </div>

  <?php include '../components/scripts.php'; ?>
</body>
</html>
