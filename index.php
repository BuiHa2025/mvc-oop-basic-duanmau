<?php 
// Khởi tạo session
session_start();

// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/AuthController.php';
require_once './controllers/CategoryController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/UserModel.php';
require_once './models/CategoryModel.php';
require_once './models/BannerModel.php';
require_once './models/ArticleModel.php';

// Route
$act = $_GET['act'] ?? '/';

try {
    // Để bảo đảm tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
    match ($act) {
        // Trang chủ - Tất cả user đều có thể truy cập
        '/' => (new ProductController())->Home(),
        'search' => (new ProductController())->search(),
        'category' => (new ProductController())->productsByCategory(),
        'chitiet' => (new ProductController())->showDetail(),
        'products-listing' => (new ProductController())->listing(),
        
        // Authentication routes - Tất cả user đều có thể truy cập
        'login' => (new AuthController())->login(),
        'register' => (new AuthController())->register(),
        'logout' => (new AuthController())->logout(),
        
        // Category routes - Chỉ admin mới có thể truy cập (kiểm tra trong controller)
        'categories' => (new CategoryController())->index(),
        'category-create' => (new CategoryController())->create(),
        'category-edit' => (new CategoryController())->edit(),
        'category-delete' => (new CategoryController())->delete(),
        'category-show' => (new CategoryController())->show(),
        
        // Product CRUD routes - Chỉ admin mới có thể truy cập (kiểm tra trong controller)
        'products' => (new ProductController())->index(),
        'product-create' => (new ProductController())->create(),
        'product-edit' => (new ProductController())->edit(),
        'product-delete' => (new ProductController())->delete(),
        
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
