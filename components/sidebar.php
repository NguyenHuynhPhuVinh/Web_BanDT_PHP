<!-- Sidebar -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <h3><i class="bi bi-phone"></i> PhoneStore</h3>
    <p>Quản lý cửa hàng điện thoại</p>
  </div>
  <ul class="sidebar-menu">
    <li><a href="<?php echo $base_url; ?>index.php" class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/products.php" class="<?php echo $page == 'products' ? 'active' : ''; ?>"><i class="bi bi-box-seam"></i><span>Sản phẩm</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/orders.php" class="<?php echo $page == 'orders' ? 'active' : ''; ?>"><i class="bi bi-receipt"></i><span>Đơn hàng</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/customers.php" class="<?php echo $page == 'customers' ? 'active' : ''; ?>"><i class="bi bi-people"></i><span>Khách hàng</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/inventory.php" class="<?php echo $page == 'inventory' ? 'active' : ''; ?>"><i class="bi bi-archive"></i><span>Quản lý kho</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/promotions.php" class="<?php echo $page == 'promotions' ? 'active' : ''; ?>"><i class="bi bi-tag"></i><span>Khuyến mãi</span></a></li>
    <li class="menu-divider"><a href="<?php echo $base_url; ?>pages/users.php" class="<?php echo $page == 'users' ? 'active' : ''; ?>"><i class="bi bi-person-gear"></i><span>Người dùng</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/suppliers.php" class="<?php echo $page == 'suppliers' ? 'active' : ''; ?>"><i class="bi bi-truck"></i><span>Nhà cung cấp</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/categories.php" class="<?php echo $page == 'categories' ? 'active' : ''; ?>"><i class="bi bi-grid"></i><span>Danh mục</span></a></li>
    <li><a href="<?php echo $base_url; ?>pages/reports.php" class="<?php echo $page == 'reports' ? 'active' : ''; ?>"><i class="bi bi-graph-up"></i><span>Báo cáo</span></a></li>
    <li><a href="<?php echo $base_url; ?>login.php"><i class="bi bi-box-arrow-right"></i><span>Đăng xuất</span></a></li>
  </ul>
</aside>
