<?php 
$page_title = "Quản lý danh mục";
$current_page = "categories";
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
        </div>
      </div>

      <?php include '../components/footer.php'; ?>
    </div>
  </div>

  <?php include '../components/scripts.php'; ?>
</body>
</html>
