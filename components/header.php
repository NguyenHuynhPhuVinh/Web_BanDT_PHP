<?php
// Get user info from session
$user_fullname = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'User';
$user_role = 'Nhân viên';
if(isset($_SESSION['role_id'])) {
    if($_SESSION['role_id'] == 1) $user_role = 'Quản trị viên';
    if($_SESSION['role_id'] == 2) $user_role = 'Quản lý';
}
$avatar_url = isset($_SESSION['avatar']) && $_SESSION['avatar'] != 'default-avatar.png' ? $base_url . 'assets/uploads/avatars/' . $_SESSION['avatar'] : null;
$user_initial = substr($user_fullname, 0, 1);
?>
<!-- Header -->
<header class="header">
  <div class="header-left">
    <h2><?php echo $page_title; ?></h2>
  </div>
  <div class="header-right">
    <div class="header-search">
      <input type="text" placeholder="Tìm kiếm...">
      <i class="bi bi-search"></i>
    </div>
    <div class="header-user">
      <?php if($avatar_url && file_exists(str_replace($base_url, '', $avatar_url))): ?>
        <img src="<?php echo $avatar_url; ?>" class="user-avatar user-avatar-img">
      <?php else: ?>
        <div class="user-avatar"><?php echo strtoupper($user_initial); ?></div>
      <?php endif; ?>
      <div class="user-info">
        <div class="user-info-name"><?php echo $user_fullname; ?></div>
        <div class="user-info-role"><?php echo $user_role; ?></div>
      </div>
    </div>
  </div>
</header>
