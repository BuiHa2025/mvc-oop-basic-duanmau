<?php
// CategoryController - Chứa các function thực thi xử lý logic cho danh mục
class CategoryController
{
    public $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new CategoryModel();
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $title = "Quản lý danh mục";
        $categories = $this->modelCategory->getAllCategories();
        $totalCategories = $this->modelCategory->countCategories();
        
        // Hiển thị thông báo nếu có
        $message = $_SESSION['message'] ?? '';
        $messageType = $_SESSION['message_type'] ?? '';
        unset($_SESSION['message'], $_SESSION['message_type']);
        
        require_once PATH_VIEW . 'categories/index.php';
    }

    // Hiển thị form tạo danh mục mới
    public function create()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $title = "Thêm danh mục mới";
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            // Validate dữ liệu
            if (empty($name)) {
                $error = "Tên danh mục không được để trống!";
            } elseif (strlen($name) < 2) {
                $error = "Tên danh mục phải có ít nhất 2 ký tự!";
            } elseif ($this->modelCategory->checkCategoryNameExists($name)) {
                $error = "Tên danh mục đã tồn tại!";
            } else {
                // Tạo danh mục mới
                $result = $this->modelCategory->createCategory($name, $description);
                if ($result) {
                    $_SESSION['message'] = "Thêm danh mục thành công!";
                    $_SESSION['message_type'] = "success";
                    header('Location: index.php?act=categories');
                    exit();
                } else {
                    $error = "Có lỗi xảy ra khi thêm danh mục!";
                }
            }
        }
        
        require_once PATH_VIEW . 'categories/create.php';
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['message'] = "ID danh mục không hợp lệ!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=categories');
            exit();
        }
        
        $category = $this->modelCategory->getCategoryById($id);
        if (!$category) {
            $_SESSION['message'] = "Không tìm thấy danh mục!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=categories');
            exit();
        }
        
        $title = "Chỉnh sửa danh mục: " . $category['name'];
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            // Validate dữ liệu
            if (empty($name)) {
                $error = "Tên danh mục không được để trống!";
            } elseif (strlen($name) < 2) {
                $error = "Tên danh mục phải có ít nhất 2 ký tự!";
            } elseif ($this->modelCategory->checkCategoryNameExists($name, $id)) {
                $error = "Tên danh mục đã tồn tại!";
            } else {
                // Cập nhật danh mục
                $result = $this->modelCategory->updateCategory($id, $name, $description);
                if ($result) {
                    $_SESSION['message'] = "Cập nhật danh mục thành công!";
                    $_SESSION['message_type'] = "success";
                    header('Location: index.php?act=categories');
                    exit();
                } else {
                    $error = "Có lỗi xảy ra khi cập nhật danh mục!";
                }
            }
        }
        
        require_once PATH_VIEW . 'categories/edit.php';
    }

    // Xóa danh mục
    public function delete()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['message'] = "ID danh mục không hợp lệ!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=categories');
            exit();
        }
        
        // Kiểm tra danh mục có tồn tại không
        $category = $this->modelCategory->getCategoryById($id);
        if (!$category) {
            $_SESSION['message'] = "Không tìm thấy danh mục!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=categories');
            exit();
        }
        
        // Xóa danh mục
        $result = $this->modelCategory->deleteCategory($id);
        if ($result) {
            $_SESSION['message'] = "Xóa danh mục '{$category['name']}' thành công!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Có lỗi xảy ra khi xóa danh mục!";
            $_SESSION['message_type'] = "error";
        }
        
        header('Location: index.php?act=categories');
        exit();
    }

    // Hiển thị chi tiết danh mục (tùy chọn)
    public function show()
    {
        // Kiểm tra quyền admin
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            header('Location: index.php?act=categories');
            exit();
        }
        
        $category = $this->modelCategory->getCategoryById($id);
        if (!$category) {
            $_SESSION['message'] = "Không tìm thấy danh mục!";
            $_SESSION['message_type'] = "error";
            header('Location: index.php?act=categories');
            exit();
        }
        
        $title = "Chi tiết danh mục: " . $category['name'];
        
        require_once PATH_VIEW . 'categories/show.php';
    }
}