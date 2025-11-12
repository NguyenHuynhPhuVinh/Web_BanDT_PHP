// ===================================
// MAIN JAVASCRIPT - Placeholder
// Sẽ xử lý PHP và JS sau
// ===================================

console.log('Quản lý cửa hàng điện thoại - UI Ready');

// Highlight active menu
document.addEventListener('DOMContentLoaded', function() {
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  const menuLinks = document.querySelectorAll('.sidebar-menu a');
  
  menuLinks.forEach(link => {
    if (link.getAttribute('href') === currentPage) {
      link.classList.add('active');
    }
  });
});
