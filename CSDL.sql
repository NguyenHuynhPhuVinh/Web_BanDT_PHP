-- =================================================================
-- SCRIPT TẠO CƠ SỞ DỮ LIỆU VÀ BẢNG CHO
-- DỰ ÁN WEBSITE QUẢN LÝ CỬA HÀNG ĐIỆN THOẠI
-- =================================================================
-- Version: 1.2 - Thêm lệnh tạo CSDL.

-- PHẦN 1: TẠO VÀ SỬ DỤNG CƠ SỞ DỮ LIỆU
-- =================================================================

-- Tạo cơ sở dữ liệu 'db_quanlydienthoai' nếu nó chưa tồn tại.
-- Sử dụng bộ ký tự utf8mb4 và đối chiếu utf8mb4_unicode_ci để hỗ trợ tiếng Việt có dấu.
CREATE DATABASE IF NOT EXISTS `db_quanlydienthoai` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Chọn cơ sở dữ liệu vừa tạo để thực hiện các lệnh tiếp theo.
USE `db_quanlydienthoai`;

-- =================================================================
-- PHẦN 2: CÀI ĐẶT BAN ĐẦU VÀ XÓA BẢNG CŨ (NẾU CÓ)
-- =================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- Xóa các bảng nếu tồn tại để tránh lỗi (theo thứ tự ngược của khóa ngoại)
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `stock_movements`;
DROP TABLE IF EXISTS `promotions`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `suppliers`;
DROP TABLE IF EXISTS `customers`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;

-- =================================================================
-- PHẦN 3: TẠO CẤU TRÚC CÁC BẢNG
-- =================================================================

-- Bảng 1: roles (Quản lý vai trò người dùng)
CREATE TABLE `roles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Tên vai trò (admin, manager, sales, warehouse)',
  `description` TEXT COMMENT 'Mô tả chi tiết quyền hạn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu các vai trò trong hệ thống';

-- Bảng 2: users (Quản lý người dùng)
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `role_id` INT NOT NULL COMMENT 'Liên kết tới bảng roles',
  `username` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Tên đăng nhập',
  `password` VARCHAR(255) NOT NULL COMMENT 'Mật khẩu đã được mã hóa (hashed)',
  `full_name` VARCHAR(100) NOT NULL COMMENT 'Họ và tên đầy đủ',
  `email` VARCHAR(100) UNIQUE COMMENT 'Email người dùng',
  `phone` VARCHAR(15) COMMENT 'Số điện thoại',
  `status` ENUM('active', 'inactive') DEFAULT 'active' COMMENT 'Trạng thái tài khoản',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Lưu thông tin tài khoản người dùng';

-- Bảng 3: categories (Danh mục sản phẩm)
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `name` VARCHAR(100) UNIQUE NOT NULL COMMENT 'Tên danh mục (iPhone, Samsung...)',
  `description` TEXT COMMENT 'Mô tả danh mục',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 4: suppliers (Nhà cung cấp)
CREATE TABLE `suppliers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `name` VARCHAR(150) UNIQUE NOT NULL COMMENT 'Tên nhà cung cấp (Apple Vietnam)',
  `phone` VARCHAR(15) NOT NULL COMMENT 'Số điện thoại liên hệ',
  `email` VARCHAR(100) UNIQUE COMMENT 'Email',
  `address` TEXT COMMENT 'Địa chỉ cơ sở kinh doanh',
  `city` VARCHAR(100) COMMENT 'Thành phố',
  `contact_person` VARCHAR(100) COMMENT 'Người liên hệ',
  `tax_id` VARCHAR(50) COMMENT 'Mã số thuế',
  `notes` TEXT COMMENT 'Ghi chú thêm',
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_name` (`name`),
  INDEX `idx_phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 5: products (Sản phẩm)
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `category_id` INT NOT NULL COMMENT 'Danh mục sản phẩm',
  `name` VARCHAR(200) NOT NULL COMMENT 'Tên sản phẩm (iPhone 15 Pro)',
  `sku` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Mã sản phẩm (IP15P)',
  `description` TEXT COMMENT 'Mô tả chi tiết',
  `price` DECIMAL(12,2) NOT NULL COMMENT 'Giá bán (₫)',
  `cost` DECIMAL(12,2) COMMENT 'Giá vốn (₫)',
  `quantity` INT DEFAULT 0 COMMENT 'Tồn kho hiện tại',
  `min_quantity` INT DEFAULT 10 COMMENT 'Mức cảnh báo tồn kho',
  `image` VARCHAR(255) COMMENT 'Đường dẫn ảnh sản phẩm',
  `status` ENUM('active', 'inactive') DEFAULT 'active' COMMENT 'Trạng thái (còn bán/ngừng bán)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT,
  INDEX `idx_category` (`category_id`),
  INDEX `idx_sku` (`sku`),
  INDEX `idx_quantity` (`quantity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 6: promotions (Khuyến mãi)
CREATE TABLE `promotions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `name` VARCHAR(200) NOT NULL COMMENT 'Tên khuyến mãi',
  `description` TEXT COMMENT 'Mô tả chi tiết',
  `discount_type` ENUM('fixed', 'percent') NOT NULL COMMENT 'fixed=cố định(₫), percent=(%)',
  `discount_value` DECIMAL(12,2) NOT NULL COMMENT 'Giá trị chiết khấu',
  `product_id` INT COMMENT 'Áp dụng cho sản phẩm cụ thể (NULL=tất cả)',
  `min_amount` DECIMAL(12,2) COMMENT 'Giá trị đơn hàng tối thiểu để áp dụng (₫)',
  `start_date` DATE NOT NULL COMMENT 'Ngày bắt đầu',
  `end_date` DATE NOT NULL COMMENT 'Ngày kết thúc',
  `active` TINYINT(1) DEFAULT 1 COMMENT '1=kích hoạt, 0=vô hiệu',
  `priority` INT DEFAULT 0 COMMENT 'Ưu tiên áp dụng (số lớn hơn ưu tiên cao hơn)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL,
  INDEX `idx_active_date` (`active`, `start_date`, `end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 7: stock_movements (Lịch sử nhập/xuất kho)
CREATE TABLE `stock_movements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `product_id` INT NOT NULL COMMENT 'Sản phẩm',
  `user_id` INT COMMENT 'Nhân viên thực hiện',
  `supplier_id` INT COMMENT 'Nhà cung cấp (chỉ khi type=in)',
  `order_id` INT COMMENT 'Mã đơn hàng (chỉ khi type=out do bán hàng)',
  `type` ENUM('in', 'out') NOT NULL COMMENT 'in=nhập, out=xuất',
  `quantity` INT NOT NULL COMMENT 'Số lượng thay đổi (+/-)',
  `reference_number` VARCHAR(50) COMMENT 'Mã tham chiếu (Mã phiếu nhập, mã đơn hàng)',
  `notes` TEXT COMMENT 'Ghi chú',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`supplier_id`) REFERENCES `suppliers`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  INDEX `idx_product` (`product_id`),
  INDEX `idx_date` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 8: customers (Khách hàng)
CREATE TABLE `customers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `name` VARCHAR(100) NOT NULL COMMENT 'Tên khách hàng',
  `phone` VARCHAR(15) UNIQUE COMMENT 'Số điện thoại (duy nhất)',
  `email` VARCHAR(100) UNIQUE COMMENT 'Email (duy nhất)',
  `address` TEXT COMMENT 'Địa chỉ nhận hàng',
  `city` VARCHAR(100) COMMENT 'Thành phố',
  `total_purchases` DECIMAL(15,2) DEFAULT 0.00 COMMENT 'Tổng tiền đã mua (cập nhật tự động)',
  `purchase_count` INT DEFAULT 0 COMMENT 'Số lần mua (cập nhật tự động)',
  `loyalty_points` INT DEFAULT 0 COMMENT 'Điểm thành viên',
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_phone` (`phone`),
  INDEX `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 9: orders (Hóa đơn)
CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `order_number` VARCHAR(50) UNIQUE NOT NULL COMMENT 'Mã hóa đơn (HD20251112001)',
  `customer_id` INT COMMENT 'Khách hàng (NULL=khách lẻ)',
  `user_id` INT COMMENT 'Nhân viên tạo đơn',
  `subtotal` DECIMAL(15,2) DEFAULT 0.00 COMMENT 'Tổng tiền hàng trước chiết khấu',
  `discount` DECIMAL(15,2) DEFAULT 0.00 COMMENT 'Chiết khấu trên toàn đơn',
  `tax` DECIMAL(15,2) DEFAULT 0.00 COMMENT 'Thuế (nếu có)',
  `total_amount` DECIMAL(15,2) NOT NULL COMMENT 'Tổng tiền phải trả',
  `payment_method` ENUM('cash', 'card', 'transfer', 'cod') DEFAULT 'cash' COMMENT 'Phương thức thanh toán',
  `status` ENUM('pending', 'completed', 'cancelled', 'refunded') DEFAULT 'pending' COMMENT 'Trạng thái đơn hàng',
  `notes` TEXT COMMENT 'Ghi chú thêm',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  INDEX `idx_order_number` (`order_number`),
  INDEX `idx_status` (`status`),
  INDEX `idx_date` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng 10: order_items (Chi tiết hóa đơn)
CREATE TABLE `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Khóa chính',
  `order_id` INT NOT NULL COMMENT 'Liên kết đến Hóa đơn',
  `product_id` INT NOT NULL COMMENT 'Liên kết đến Sản phẩm',
  `quantity` INT NOT NULL COMMENT 'Số lượng',
  `unit_price` DECIMAL(12,2) NOT NULL COMMENT 'Giá bán tại thời điểm mua',
  `discount_applied` DECIMAL(12,2) DEFAULT 0.00 COMMENT 'Chiết khấu trên từng item',
  `subtotal` DECIMAL(12,2) GENERATED ALWAYS AS (`quantity` * `unit_price` - `discount_applied`) STORED COMMENT 'Thành tiền (tự động tính)',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================================
-- PHẦN 4: TRIGGERS - CÁC HÀNH ĐỘNG TỰ ĐỘNG
-- =================================================================

DELIMITER $$

-- Trigger: Tự động cập nhật tồn kho khi có phiếu nhập/xuất
CREATE TRIGGER `after_stock_movement_insert`
AFTER INSERT ON `stock_movements`
FOR EACH ROW
BEGIN
    IF NEW.type = 'in' THEN
        UPDATE `products` SET `quantity` = `quantity` + NEW.quantity WHERE `id` = NEW.product_id;
    ELSEIF NEW.type = 'out' THEN
        UPDATE `products` SET `quantity` = `quantity` - NEW.quantity WHERE `id` = NEW.product_id;
    END IF;
END$$

-- Trigger: Tự động cập nhật tổng mua của khách hàng khi đơn hàng hoàn thành
CREATE TRIGGER `after_order_completed`
AFTER UPDATE ON `orders`
FOR EACH ROW
BEGIN
    IF NEW.status = 'completed' AND OLD.status != 'completed' AND NEW.customer_id IS NOT NULL THEN
        UPDATE `customers`
        SET
            `total_purchases` = `total_purchases` + NEW.total_amount,
            `purchase_count` = `purchase_count` + 1
        WHERE `id` = NEW.customer_id;
    END IF;
END$$

DELIMITER ;

-- =================================================================
-- PHẦN 5: CHÈN DỮ LIỆU MẪU
-- =================================================================

-- 1. Roles
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Quản trị viên - Tất cả quyền'),
(2, 'manager', 'Quản lý cửa hàng - Xem báo cáo, quản lý khuyến mãi'),
(3, 'sales', 'Nhân viên bán hàng - Tạo đơn hàng, quản lý khách hàng'),
(4, 'warehouse', 'Nhân viên kho - Quản lý nhập/xuất kho');

-- 2. Users (Mật khẩu mẫu '123456', bạn cần hash trong code PHP)
INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `full_name`, `email`) VALUES
(1, 1, 'admin', '$2y$10$E.gL3k0aR4H8s2p.d8I.iO2U.X1u/i4s/b5F.w8c7J8y9a0b1c2d3', 'Toàn Diện', 'admin@email.com'),
(2, 2, 'manager01', '$2y$10$E.gL3k0aR4H8s2p.d8I.iO2U.X1u/i4s/b5F.w8c7J8y9a0b1c2d3', 'An Nguyễn', 'manager@email.com'),
(3, 3, 'sales01', '$2y$10$E.gL3k0aR4H8s2p.d8I.iO2U.X1u/i4s/b5F.w8c7J8y9a0b1c2d3', 'Bình Minh', 'sales@email.com'),
(4, 4, 'kho01', '$2y$10$E.gL3k0aR4H8s2p.d8I.iO2U.X1u/i4s/b5F.w8c7J8y9a0b1c2d3', 'Cường Trần', 'warehouse@email.com');

-- 3. Categories
INSERT INTO `categories` (`name`, `description`) VALUES
('iPhone', 'Điện thoại Apple'),
('Samsung', 'Điện thoại Samsung'),
('Xiaomi', 'Điện thoại Xiaomi'),
('OPPO', 'Điện thoại OPPO');

-- 4. Suppliers
INSERT INTO `suppliers` (`name`, `phone`, `email`, `address`, `city`) VALUES
('FPT Trading', '02873000911', 'info@fpt.com.vn', 'Số 10, Phạm Văn Bạch, Cầu Giấy', 'Hà Nội'),
('Digiworld', '02839268888', 'contact@dgw.com.vn', '195-197 Nguyễn Thái Bình, Quận 1', 'TP HCM');

-- 5. Products
INSERT INTO `products` (`category_id`, `name`, `sku`, `description`, `price`, `cost`, `quantity`, `min_quantity`) VALUES
(1, 'iPhone 15 Pro Max 256GB', 'IP15PM256', 'Titan tự nhiên, chip A17 Pro', 32000000, 28500000, 50, 5),
(2, 'Samsung Galaxy S24 Ultra 512GB', 'SS24U512', 'Galaxy AI, bút S Pen tích hợp', 31500000, 27000000, 30, 5),
(3, 'Xiaomi 14 256GB', 'XI14256', 'Hợp tác Leica, sạc nhanh 90W', 15990000, 13000000, 80, 10);

-- 6. Customers
INSERT INTO `customers` (`name`, `phone`, `email`, `address`, `city`) VALUES
('Nguyễn Văn A', '0912345678', 'nguyenvana@gmail.com', '123 Nguyễn Trãi, Q5', 'TP HCM'),
('Trần Thị B', '0987654321', 'tranthib@gmail.com', '456 Lê Lợi, Q1', 'TP HCM');

-- 7. Promotions
INSERT INTO `promotions` (`name`, `discount_type`, `discount_value`, `min_amount`, `start_date`, `end_date`) VALUES
('Giảm giá cuối tuần', 'percent', 5, 20000000, '2024-05-20', '2025-12-31'),
('Voucher 500k', 'fixed', 500000, 15000000, '2024-05-20', '2025-12-31');


-- Xác nhận tất cả các thay đổi
COMMIT;