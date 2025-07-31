<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';

try {
    // Để bảo đảm tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
    match ($act) {
        // Trang chủ
        '/' => (new ProductController())->Home(),
        'chitiet' => (new ProductController())->showDetail(),
        // Thêm route mặc định cho các trường hợp không khớp
        default => (new ProductController())->Home()
    };
} catch (Exception $e) {
    // Xử lý lỗi và hiển thị trang lỗi
    echo "Lỗi: " . $e->getMessage();
    // Hoặc chuyển hướng về trang chủ
    header('Location: index.php');
    exit();
}
