<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel 
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách sản phẩm 
    public function getAllProduct()
    {
        try {
            $sql = "SELECT * FROM products ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy chi tiết sản phẩm theo ID
    public function getProductById($id)
    {
        try {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

    // Lấy sản phẩm hot (có thể dựa vào trường is_hot hoặc view_count)
    public function getHotProducts($limit = 4)
    {
        try {
            $sql = "SELECT * FROM products WHERE is_hot = 1 ORDER BY id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy sản phẩm mới
    public function getNewProducts($limit = 6)
    {
        try {
            $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy sản phẩm nổi bật
    public function getFeaturedProducts($limit = 8)
    {
        try {
            $sql = "SELECT * FROM products WHERE is_featured = 1 ORDER BY id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
}
