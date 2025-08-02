<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    public function Home()
    {
        $title = "Trang chủ - Cửa hàng rượu";
        
        // Lấy dữ liệu từ model
        $hotProducts = $this->modelProduct->getHotProducts(4);
        $newProducts = $this->modelProduct->getNewProducts(6);
        $featuredProducts = $this->modelProduct->getFeaturedProducts(8);
        
        require_once './views/trangchu.php';
    }

    public function showDetail() 
    {
        // Lấy ID từ URL
        $id = $_GET['id'] ?? 1;
        
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            $id = 1;
        }
        
        // Lấy thông tin sản phẩm từ model
        $product = $this->modelProduct->getProductById($id);
        
        // Nếu không tìm thấy sản phẩm, chuyển về trang chủ
        if (!$product) {
            header('Location: index.php');
            exit();
        }
        
        $title = "Chi tiết sản phẩm - " . ($product['name'] ?? 'Sản phẩm');
        
        require_once PATH_VIEW . 'products/detail.php';
    }

    // Thêm method hiển thị danh sách sản phẩm
    public function listProducts()
    {
        $title = "Danh sách sản phẩm";
        $products = $this->modelProduct->getAllProduct();
        
        require_once PATH_VIEW . 'products/list.php';
    }
    
}
