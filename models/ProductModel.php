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
            $sql = "SELECT * FROM products ORDER BY id DESC LIMIT :limit";
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

    // Tạo sản phẩm mới
    public function createProduct($name, $description, $price, $image, $category_id, $stock_quantity, $is_hot = 0, $is_featured = 0, $status = 'active')
    {
        try {
            $sql = "INSERT INTO products (name, description, price, image, category_id, stock_quantity, is_hot, is_featured, status)
                    VALUES (:name, :description, :price, :image, :category_id, :stock_quantity, :is_hot, :is_featured, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock_quantity', $stock_quantity, PDO::PARAM_INT);
            $stmt->bindParam(':is_hot', $is_hot, PDO::PARAM_INT);
            $stmt->bindParam(':is_featured', $is_featured, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $name, $description, $price, $image, $category_id, $stock_quantity, $is_hot = 0, $is_featured = 0, $status = 'active')
    {
        try {
            $sql = "UPDATE products SET name = :name, description = :description, price = :price, image = :image,
                    category_id = :category_id, stock_quantity = :stock_quantity, is_hot = :is_hot,
                    is_featured = :is_featured, status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock_quantity', $stock_quantity, PDO::PARAM_INT);
            $stmt->bindParam(':is_hot', $is_hot, PDO::PARAM_INT);
            $stmt->bindParam(':is_featured', $is_featured, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        try {
            // Kiểm tra xem sản phẩm có tồn tại không
            $checkSql = "SELECT id FROM products WHERE id = :id";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() == 0) {
                return false; // Sản phẩm không tồn tại
            }

            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Tìm kiếm sản phẩm
    public function searchProducts($keyword, $category_id = null, $status = null)
    {
        try {
            $sql = "SELECT p.*, c.name as category_name FROM products p
                    LEFT JOIN categories c ON p.category_id = c.id
                    WHERE 1=1";
            $params = [];

            if (!empty($keyword)) {
                $sql .= " AND (p.name LIKE :keyword OR p.description LIKE :keyword)";
                $params[':keyword'] = '%' . $keyword . '%';
            }

            if (!empty($category_id)) {
                $sql .= " AND p.category_id = :category_id";
                $params[':category_id'] = $category_id;
            }

            if (!empty($status)) {
                $sql .= " AND p.status = :status";
                $params[':status'] = $status;
            }

            $sql .= " ORDER BY p.id DESC";

            $stmt = $this->conn->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy sản phẩm với thông tin danh mục
    public function getAllProductsWithCategory()
    {
        try {
            $sql = "SELECT p.*, c.name as category_name FROM products p
                    LEFT JOIN categories c ON p.category_id = c.id
                    ORDER BY p.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Đếm tổng số sản phẩm
    public function countProducts($status = null)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM products";
            if ($status) {
                $sql .= " WHERE status = :status";
            }
            $stmt = $this->conn->prepare($sql);
            if ($status) {
                $stmt->bindParam(':status', $status);
            }
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['total'];
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return 0;
        }
    }

    // Kiểm tra tên sản phẩm đã tồn tại
    public function checkProductNameExists($name, $excludeId = null)
    {
        try {
            if ($excludeId) {
                $sql = "SELECT id FROM products WHERE name = :name AND id != :excludeId";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':excludeId', $excludeId, PDO::PARAM_INT);
            } else {
                $sql = "SELECT id FROM products WHERE name = :name";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':name', $name);
            }
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Lấy sản phẩm liên quan (cùng danh mục)
    public function getRelatedProducts($productId, $categoryId, $limit = 4)
    {
        try {
            $sql = "SELECT * FROM products WHERE id != :productId AND category_id = :categoryId AND status = 'active' ORDER BY id DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
}
