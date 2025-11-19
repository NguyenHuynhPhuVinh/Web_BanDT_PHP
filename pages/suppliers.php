<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý nhà cung cấp - PhoneStore</title>
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
        <li class="menu-divider"><a href="users.html"><i class="bi bi-person-gear"></i><span>Người dùng</span></a></li>
        <li><a href="suppliers.html" class="active"><i class="bi bi-truck"></i><span>Nhà cung cấp</span></a></li>
        <li><a href="categories.html"><i class="bi bi-grid"></i><span>Danh mục</span></a></li>
        <li><a href="reports.html"><i class="bi bi-graph-up"></i><span>Báo cáo</span></a></li>
        <li><a href="#"><i class="bi bi-box-arrow-right"></i><span>Đăng xuất</span></a></li>
      </ul>
    </aside>

    <div class="main-content">
      <header class="header">
        <div class="header-left">
          <h2>Quản lý nhà cung cấp</h2>
        </div>
        <div class="header-right">
          <div class="header-search">
            <input type="text" placeholder="Tìm nhà cung cấp...">
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
          <h1>Danh sách nhà cung cấp</h1>
          <div class="breadcrumb">Trang chủ / Nhà cung cấp</div>
        </div>

        <!-- Stats -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon blue">
                <i class="bi bi-truck"></i>
              </div>
              <div class="stat-info">
                <h4>Tổng NCC</h4>
                <div class="stat-value">15</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon green">
                <i class="bi bi-check-circle"></i>
              </div>
              <div class="stat-info">
                <h4>Đang hợp tác</h4>
                <div class="stat-value">12</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon red">
                <i class="bi bi-x-circle"></i>
              </div>
              <div class="stat-info">
                <h4>Ngừng hợp tác</h4>
                <div class="stat-value">3</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter -->
        <div class="filter-bar">
          <div class="filter-row">
            <div class="filter-group">
              <label>Thành phố</label>
              <select class="form-control">
                <option>Tất cả</option>
                <option>Hà Nội</option>
                <option>TP HCM</option>
                <option>Đà Nẵng</option>
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
                <i class="bi bi-plus-circle"></i> Thêm nhà cung cấp
              </button>
            </div>
          </div>
        </div>

        <!-- Suppliers Table -->
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table>
                <thead>
                  <tr>
                    <th>Mã NCC</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Liên hệ</th>
                    <th>Địa chỉ</th>
                    <th>Người liên hệ</th>
                    <th>Mã số thuế</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>#NCC001</strong></td>
                    <td>
                      <div style="font-weight: 600;">FPT Trading</div>
                      <small style="color: var(--text-muted);">Nhà phân phối chính hãng</small>
                    </td>
                    <td>
                      <div><i class="bi bi-phone"></i> 02873000911</div>
                      <small style="color: var(--text-muted);"><i class="bi bi-envelope"></i> info@fpt.com.vn</small>
                    </td>
                    <td>Số 10, Phạm Văn Bạch<br><small>Hà Nội</small></td>
                    <td>Nguyễn Văn A</td>
                    <td><small>0100109106</small></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                      <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>#NCC002</strong></td>
                    <td>
                      <div style="font-weight: 600;">Digiworld</div>
                      <small style="color: var(--text-muted);">Nhà phân phối điện thoại</small>
                    </td>
                    <td>
                      <div><i class="bi bi-phone"></i> 02839268888</div>
                      <small style="color: var(--text-muted);"><i class="bi bi-envelope"></i> contact@dgw.com.vn</small>
                    </td>
                    <td>195-197 Nguyễn Thái Bình<br><small>TP HCM</small></td>
                    <td>Trần Thị B</td>
                    <td><small>0301234567</small></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                      <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>#NCC003</strong></td>
                    <td>
                      <div style="font-weight: 600;">Thế Giới Di Động</div>
                      <small style="color: var(--text-muted);">Đối tác bán lẻ</small>
                    </td>
                    <td>
                      <div><i class="bi bi-phone"></i> 1800123456</div>
                      <small style="color: var(--text-muted);"><i class="bi bi-envelope"></i> info@thegioididong.com</small>
                    </td>
                    <td>128 Trần Quang Khải, Q1<br><small>TP HCM</small></td>
                    <td>Lê Văn C</td>
                    <td><small>0302345678</small></td>
                    <td><span class="badge badge-success">Active</span></td>
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
