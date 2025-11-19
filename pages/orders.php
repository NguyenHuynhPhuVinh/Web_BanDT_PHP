<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý đơn hàng - PhoneStore</title>
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
        <li><a href="orders.html" class="active"><i class="bi bi-receipt"></i><span>Đơn hàng</span></a></li>
        <li><a href="customers.html"><i class="bi bi-people"></i><span>Khách hàng</span></a></li>
        <li><a href="inventory.html"><i class="bi bi-archive"></i><span>Quản lý kho</span></a></li>
        <li><a href="promotions.html"><i class="bi bi-tag"></i><span>Khuyến mãi</span></a></li>
        <li class="menu-divider"><a href="users.html"><i class="bi bi-person-gear"></i><span>Người dùng</span></a></li>
        <li><a href="suppliers.html"><i class="bi bi-truck"></i><span>Nhà cung cấp</span></a></li>
        <li><a href="categories.html"><i class="bi bi-grid"></i><span>Danh mục</span></a></li>
        <li><a href="reports.html"><i class="bi bi-graph-up"></i><span>Báo cáo</span></a></li>
        <li><a href="#"><i class="bi bi-box-arrow-right"></i><span>Đăng xuất</span></a></li>
      </ul>
    </aside>

    <div class="main-content">
      <header class="header">
        <div class="header-left">
          <h2>Quản lý đơn hàng</h2>
        </div>
        <div class="header-right">
          <div class="header-search">
            <input type="text" placeholder="Tìm mã đơn, khách hàng...">
            <i class="bi bi-search"></i>
          </div>
          <div class="header-user">
            <div class="user-avatar">AD</div>
            <div class="user-info">
              <div style="font-weight: 600; font-size: 0.9rem;">Admin</div>
              <div style="font-size: 0.8rem; color: var(--secondary);">Quản trị viên</div>
            </div>
          </div>
        </div>
      </header>

      <div class="content">
        <div class="page-title">
          <h1>Danh sách đơn hàng</h1>
          <div class="breadcrumb">Trang chủ / Đơn hàng</div>
        </div>

        <!-- Stats -->
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon blue">
                <i class="bi bi-receipt"></i>
              </div>
              <div class="stat-info">
                <h4>Tổng đơn hàng</h4>
                <div class="stat-value">248</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon green">
                <i class="bi bi-check-circle"></i>
              </div>
              <div class="stat-info">
                <h4>Hoàn thành</h4>
                <div class="stat-value">195</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon orange">
                <i class="bi bi-clock"></i>
              </div>
              <div class="stat-info">
                <h4>Đang xử lý</h4>
                <div class="stat-value">42</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon red">
                <i class="bi bi-x-circle"></i>
              </div>
              <div class="stat-info">
                <h4>Đã hủy</h4>
                <div class="stat-value">11</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter -->
        <div class="filter-bar">
          <div class="filter-row">
            <div class="filter-group">
              <label>Trạng thái</label>
              <select class="form-control">
                <option>Tất cả</option>
                <option>Chờ thanh toán</option>
                <option>Đang xử lý</option>
                <option>Hoàn thành</option>
                <option>Đã hủy</option>
              </select>
            </div>
            <div class="filter-group">
              <label>Từ ngày</label>
              <input type="date" class="form-control">
            </div>
            <div class="filter-group">
              <label>Đến ngày</label>
              <input type="date" class="form-control">
            </div>
            <div class="filter-group" style="flex: 0;">
              <label>&nbsp;</label>
              <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tạo đơn mới
              </button>
            </div>
          </div>
        </div>

        <!-- Orders Table -->
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table>
                <thead>
                  <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>HD20241112001</strong></td>
                    <td>
                      <div>Nguyễn Văn A</div>
                      <small style="color: var(--secondary);">0912345678</small>
                    </td>
                    <td>iPhone 15 Pro Max 256GB</td>
                    <td>1</td>
                    <td><strong style="color: var(--primary);">32.000.000₫</strong></td>
                    <td><span class="badge badge-primary">Tiền mặt</span></td>
                    <td><span class="badge badge-success">Hoàn thành</span></td>
                    <td>12/11/2024<br><small>10:30</small></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-printer"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>HD20241112002</strong></td>
                    <td>
                      <div>Trần Thị B</div>
                      <small style="color: var(--text-muted);">0987654321</small>
                    </td>
                    <td>Samsung Galaxy S24 Ultra</td>
                    <td>1</td>
                    <td><strong style="color: var(--primary);">31.500.000₫</strong></td>
                    <td><span class="badge badge-success">Chuyển khoản</span></td>
                    <td><span class="badge badge-warning">Đang xử lý</span></td>
                    <td>12/11/2024<br><small>11:15</small></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-printer"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>HD20241112003</strong></td>
                    <td>
                      <div>Lê Văn C</div>
                      <small style="color: var(--text-muted);">0901234567</small>
                    </td>
                    <td>Xiaomi 14 256GB</td>
                    <td>2</td>
                    <td><strong style="color: var(--primary);">31.980.000₫</strong></td>
                    <td><span class="badge badge-primary">Tiền mặt</span></td>
                    <td><span class="badge badge-success">Hoàn thành</span></td>
                    <td>12/11/2024<br><small>14:20</small></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn edit"><i class="bi bi-printer"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>HD20241112004</strong></td>
                    <td>
                      <div>Phạm Thị D</div>
                      <small style="color: var(--text-muted);">0912987654</small>
                    </td>
                    <td>iPhone 15 Pro Max 256GB</td>
                    <td>1</td>
                    <td><strong style="color: var(--primary);">32.000.000₫</strong></td>
                    <td><span class="badge badge-warning">COD</span></td>
                    <td><span class="badge badge-primary">Chờ thanh toán</span></td>
                    <td>12/11/2024<br><small>15:45</small></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
                      <button class="action-btn delete"><i class="bi bi-x-circle"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>HD20241111005</strong></td>
                    <td>
                      <div>Hoàng Văn E</div>
                      <small style="color: var(--text-muted);">0923456789</small>
                    </td>
                    <td>Samsung Galaxy S24 Ultra</td>
                    <td>1</td>
                    <td><strong style="color: var(--primary);">31.500.000₫</strong></td>
                    <td><span class="badge badge-danger">Thẻ</span></td>
                    <td><span class="badge badge-danger">Đã hủy</span></td>
                    <td>11/11/2024<br><small>16:30</small></td>
                    <td style="white-space: nowrap;">
                      <button class="action-btn view"><i class="bi bi-eye"></i></button>
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
          <button>3</button>
          <button>4</button>
          <button><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>

      <footer style="background: white; padding: 20px 30px; text-align: center; border-top: 1px solid var(--border); margin-top: auto;">
        <p style="color: var(--secondary); font-size: 0.9rem;">
          &copy; 2024 PhoneStore Management System. All rights reserved.
        </p>
      </footer>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>
