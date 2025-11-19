<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý danh mục - PhoneStore</title>
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
        <li><a href="suppliers.html"><i class="bi bi-truck"></i><span>Nhà cung cấp</span></a></li>
        <li><a href="categories.html" class="active"><i class="bi bi-grid"></i><span>Danh mục</span></a></li>
        <li><a href="reports.html"><i class="bi bi-graph-up"></i><span>Báo cáo</span></a></li>
        <li><a href="#"><i class="bi bi-box-arrow-right"></i><span>Đăng xuất</span></a></li>
      </ul>
    </aside>

    <div class="main-content">
      <header class="header">
        <div class="header-left">
          <h2>Quản lý danh mục</h2>
        </div>
        <div class="header-right">
          <div class="header-search">
            <input type="text" placeholder="Tìm danh mục...">
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
          <h1>Quản lý danh mục sản phẩm</h1>
          <div class="breadcrumb">Trang chủ / Danh mục</div>
        </div>

        <!-- Stats -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon blue">
                <i class="bi bi-grid"></i>
              </div>
              <div class="stat-info">
                <h4>Tổng danh mục</h4>
                <div class="stat-value">8</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon green">
                <i class="bi bi-box-seam"></i>
              </div>
              <div class="stat-info">
                <h4>Tổng sản phẩm</h4>
                <div class="stat-value">160</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon orange">
                <i class="bi bi-star"></i>
              </div>
              <div class="stat-info">
                <h4>Phổ biến nhất</h4>
                <div class="stat-value">iPhone</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter -->
        <div class="filter-bar">
          <div class="filter-row">
            <div class="filter-group">
              <label>Sắp xếp</label>
              <select class="form-control">
                <option>Tên A-Z</option>
                <option>Tên Z-A</option>
                <option>Nhiều sản phẩm nhất</option>
                <option>Ít sản phẩm nhất</option>
              </select>
            </div>
            <div class="filter-group" style="flex: 0;">
              <label>&nbsp;</label>
              <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm danh mục
              </button>
            </div>
          </div>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                  <div style="width: 60px; height: 60px; background: #dbeafe; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: var(--primary);">
                    <i class="bi bi-apple"></i>
                  </div>
                  <div style="flex: 1;">
                    <h4 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 4px;">iPhone</h4>
                    <small style="color: var(--text-muted); font-weight: 600;">45 sản phẩm</small>
                  </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px;">
                  Điện thoại Apple iPhone các dòng
                </p>
                <div style="display: flex; gap: 10px;">
                  <button class="action-btn view"><i class="bi bi-eye"></i></button>
                  <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                  <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                  <div style="width: 60px; height: 60px; background: #d1fae5; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: #047857;">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div style="flex: 1;">
                    <h4 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 4px;">Samsung</h4>
                    <small style="color: var(--text-muted); font-weight: 600;">38 sản phẩm</small>
                  </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px;">
                  Điện thoại Samsung Galaxy series
                </p>
                <div style="display: flex; gap: 10px;">
                  <button class="action-btn view"><i class="bi bi-eye"></i></button>
                  <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                  <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                  <div style="width: 60px; height: 60px; background: #fed7aa; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: #b45309;">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div style="flex: 1;">
                    <h4 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 4px;">Xiaomi</h4>
                    <small style="color: var(--text-muted); font-weight: 600;">32 sản phẩm</small>
                  </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px;">
                  Điện thoại Xiaomi, Redmi, POCO
                </p>
                <div style="display: flex; gap: 10px;">
                  <button class="action-btn view"><i class="bi bi-eye"></i></button>
                  <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                  <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                  <div style="width: 60px; height: 60px; background: #fecaca; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: #b91c1c;">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div style="flex: 1;">
                    <h4 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 4px;">OPPO</h4>
                    <small style="color: var(--text-muted); font-weight: 600;">25 sản phẩm</small>
                  </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px;">
                  Điện thoại OPPO các dòng
                </p>
                <div style="display: flex; gap: 10px;">
                  <button class="action-btn view"><i class="bi bi-eye"></i></button>
                  <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                  <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                  <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: var(--secondary);">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div style="flex: 1;">
                    <h4 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 4px;">Vivo</h4>
                    <small style="color: var(--text-muted); font-weight: 600;">20 sản phẩm</small>
                  </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px;">
                  Điện thoại Vivo các dòng
                </p>
                <div style="display: flex; gap: 10px;">
                  <button class="action-btn view"><i class="bi bi-eye"></i></button>
                  <button class="action-btn edit"><i class="bi bi-pencil"></i></button>
                  <button class="action-btn delete"><i class="bi bi-trash"></i></button>
                </div>
              </div>
            </div>
          </div>
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
