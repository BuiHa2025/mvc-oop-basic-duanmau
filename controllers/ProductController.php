<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;
    public $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
        $this->modelCategory = new CategoryModel();
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

    // Hiển thị danh sách sản phẩm với tìm kiếm
    public function index()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $title = "Quản lý sản phẩm";
        
        // Lấy tham số tìm kiếm
        $keyword = $_GET['keyword'] ?? '';
        $category_id = $_GET['category_id'] ?? '';
        $status = $_GET['status'] ?? '';
        
        // Tìm kiếm hoặc lấy tất cả sản phẩm
        if (!empty($keyword) || !empty($category_id) || !empty($status)) {
            $products = $this->modelProduct->searchProducts($keyword, $category_id, $status);
        } else {
            $products = $this->modelProduct->getAllProductsWithCategory();
        }
        
        // Lấy danh sách danh mục cho filter
        $categories = $this->modelCategory->getAllCategories();
        
        // Thống kê
        $totalProducts = $this->modelProduct->countProducts();
        $activeProducts = $this->modelProduct->countProducts('active');
        $inactiveProducts = $this->modelProduct->countProducts('inactive');
        
        // Hiển thị thông báo nếu có
        $message = $_SESSION['message'] ?? '';
        $messageType = $_SESSION['message_type'] ?? '';
        unset($_SESSION['message'], $_SESSION['message_type']);
        
        require_once PATH_VIEW . 'products/index.php';
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $title = "Thêm sản phẩm mới";
        $error = '';
        $categories = $this->modelCategory->getAllCategories();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $is_hot = isset($_POST['is_hot']) ? 1 : 0;
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $status = $_POST['status'] ?? 'active';
            
            // Xử lý upload hình ảnh
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = uploadFile($_FILES['image'], 'uploads/imgproduct/');
            }
            
            // Validate dữ liệu
            if (empty($name)) {
                $error = "Tên sản phẩm không được để trống!";
            } elseif (strlen($name) < 2) {
                $error = "Tên sản phẩm phải có ít nhất 2 ký tự!";
            } elseif ($price <= 0) {
                $error = "Giá sản phẩm phải lớn hơn 0!";
            } elseif ($this->modelProduct->checkProductNameExists($name)) {
                $error = "Tên sản phẩm đã tồn tại!";
            } else {
                // Tạo sản phẩm mới
                $result = $this->modelProduct->createProduct($name, $description, $price, $image, $category_id, $stock_quantity, $is_hot, $is_featured, $status);
                if ($result) {
                    $_SESSION['message'] = "Thêm sản phẩm thành công!";
                    $_SESSION['message_type'] = "success";
                    header('Location: index.php?act=products');
                    exit();
                } else {
                    $error = "Có lỗi xảy ra khi thêm sản phẩm!";
                }
            }
        }
        
        require_once PATH_VIEW . 'products/create.php';
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['message'] = "ID sản phẩm không hợp lệ!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=products');
            exit();
        }
        
        $product = $this->modelProduct->getProductById($id);
        if (!$product) {
            $_SESSION['message'] = "Không tìm thấy sản phẩm!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=products');
            exit();
        }
        
        $title = "Chỉnh sửa sản phẩm: " . $product['name'];
        $error = '';
        $categories = $this->modelCategory->getAllCategories();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $is_hot = isset($_POST['is_hot']) ? 1 : 0;
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $status = $_POST['status'] ?? 'active';
            
            // Xử lý upload hình ảnh
            $image = $product['image']; // Giữ hình cũ nếu không upload mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Xóa hình cũ nếu có
                if (!empty($product['image'])) {
                    deleteFile($product['image']);
                }
                $image = uploadFile($_FILES['image'], 'uploads/imgproduct/');
            }
            
            // Validate dữ liệu
            if (empty($name)) {
                $error = "Tên sản phẩm không được để trống!";
            } elseif (strlen($name) < 2) {
                $error = "Tên sản phẩm phải có ít nhất 2 ký tự!";
            } elseif ($price <= 0) {
                $error = "Giá sản phẩm phải lớn hơn 0!";
            } elseif ($this->modelProduct->checkProductNameExists($name, $id)) {
                $error = "Tên sản phẩm đã tồn tại!";
            } else {
                // Cập nhật sản phẩm
                $result = $this->modelProduct->updateProduct($id, $name, $description, $price, $image, $category_id, $stock_quantity, $is_hot, $is_featured, $status);
                if ($result) {
                    $_SESSION['message'] = "Cập nhật sản phẩm thành công!";
                    $_SESSION['message_type'] = "success";
                    header('Location: index.php?act=products');
                    exit();
                } else {
                    $error = "Có lỗi xảy ra khi cập nhật sản phẩm!";
                }
            }
        }
        
        require_once PATH_VIEW . 'products/edit.php';
    }

    // Xóa sản phẩm
    public function delete()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['message'] = "ID sản phẩm không hợp lệ!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=products');
            exit();
        }
        
        // Kiểm tra sản phẩm có tồn tại không
        $product = $this->modelProduct->getProductById($id);
        if (!$product) {
            $_SESSION['message'] = "Không tìm thấy sản phẩm!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=products');
            exit();
        }
        
        // Xóa hình ảnh nếu có
        if (!empty($product['image'])) {
            deleteFile($product['image']);
        }
        
        // Xóa sản phẩm
        $result = $this->modelProduct->deleteProduct($id);
        if ($result) {
            $_SESSION['message'] = "Xóa sản phẩm '{$product['name']}' thành công!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Có lỗi xảy ra khi xóa sản phẩm!";
            $_SESSION['message_type'] = "error";
        }
        
        header('Location: index.php?act=products');
        exit();
    }

    // Thêm method hiển thị danh sách sản phẩm (giữ lại cho tương thích)
    public function listProducts()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $title = "Danh sách sản phẩm";
        $products = $this->modelProduct->getAllProduct();
        
        require_once PATH_VIEW . 'products/list.php';
    }
    
}
