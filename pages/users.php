<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý người dùng - PhoneStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>
<body>
  <div class="wrapper">
    <aside class="sidebar">
      <div class="sidebar-brand">
        <h3><i class="bi bi-phone"></i> PhoneStore</h3>
        <p>Quản lý cửa hàng điện thoại</p>
      </div>
      <ul class="sidebar-menu">
        <li><a href="index.html"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a></li>
        <li><a href="products.html"><i class="bi bi-box-seam"></i><span>Sản phẩm</span></a></li>
        <li><a href="orders.html"><i class="bi bi-receipt"></i><span>Đơn hàng</span></a></li>
        <li><a href="customers.html"><i class="bi bi-people"></i><span>Khách hàng</span></a></li>
        <li><a href="inventory.html"><i class="bi bi-archive"></i><span>Quản lý kho</span></a></li>
        <li><a href="promotions.html"><i class="bi bi-tag"></i><span>Khuyến mãi</span></a></li>
        <li class="menu-divider"><a href="users.html" class="active"><i class="bi bi-person-gear"></i><span>Người dùng</span></a></li>
        <li><a href="suppliers.html"><i class="bi bi-truck"></i><span>Nhà cung cấp</span></a></li>
        <li><a href="categories.html"><i class="bi bi-grid"></i><span>Danh mục</span></a></li>
        <li><a href="reports.html"><i class="bi bi-graph-up"></i><span>Báo cáo</span></a></li>
        <li><a href="#"><i class="bi bi-box-arrow-right"></i><span>Đăng xuất</span></a></li>
      </ul>
    </aside>

    <div class="main-content">
      <header class="header">
        <div class="header-left">
          <h2>Quản lý người dùng</h2>
        </div>
        <div class="header-right">
          <div class="header-search">
            <input type="text" placeholder="Tìm người dùng...">
            <i class="bi bi-search"></i>
          </div>
          <div class="header-user">
            <div class="user-avatar">AD</div>
            <div class="user-info">
              <div style="font-weight: 600; font-size: 0.9rem;">Admin</div>
              <div style="font-size: 0.8rem; color: var(--text-muted);">Quản trị viên</div>
            </div>
          </div>
        </div>
      </header>

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
            <div class="filter-group" style="flex: 0;">
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
                    <td><small style="color: var(--text-muted);">admin@email.com</small></td>
                    <td>0912345678</td>
                    <td><span class="badge badge-danger">Admin</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>01/01/2024</td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>#2</strong></td>
                    <td><strong>manager01</strong></td>
                    <td>An Nguyễn</td>
                    <td><small style="color: var(--text-muted);">manager@email.com</small></td>
                    <td>0987654321</td>
                    <td><span class="badge badge-warning">Manager</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>15/02/2024</td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                      <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>#3</strong></td>
                    <td><strong>sales01</strong></td>
                    <td>Bình Minh</td>
                    <td><small style="color: var(--text-muted);">sales@email.com</small></td>
                    <td>0901234567</td>
                    <td><span class="badge badge-primary">Sales</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>20/03/2024</td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                      <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>#4</strong></td>
                    <td><strong>kho01</strong></td>
                    <td>Cường Trần</td>
                    <td><small style="color: var(--text-muted);">warehouse@email.com</small></td>
                    <td>0923456789</td>
                    <td><span class="badge badge-secondary">Warehouse</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>10/04/2024</td>
                    <td style="white-space: nowrap;">
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

      <footer style="background: white; padding: 20px 30px; text-align: center; border-top: 1px solid var(--border); margin-top: auto;">
        <p style="color: var(--text-muted); font-size: 0.9rem;">
          &copy; 2024 PhoneStore Management System. All rights reserved.
        </p>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>
