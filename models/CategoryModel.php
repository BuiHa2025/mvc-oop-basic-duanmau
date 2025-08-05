<?php
// CategoryModel - Chứa các function thực thi tương tác với cơ sở dữ liệu cho danh mục
class CategoryModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        try {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

    // Tạo danh mục mới
    public function createCategory($name, $description)
    {
        try {
            $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $description)
    {
        try {
            $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        try {
            // Kiểm tra xem danh mục có tồn tại không
            $checkSql = "SELECT id FROM categories WHERE id = :id";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() == 0) {
                return false; // Danh mục không tồn tại
            }

            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Kiểm tra tên danh mục đã tồn tại (dùng cho validation)
    public function checkCategoryNameExists($name, $excludeId = null)
    {
        try {
            if ($excludeId) {
                $sql = "SELECT id FROM categories WHERE name = :name AND id != :excludeId";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':excludeId', $excludeId, PDO::PARAM_INT);
            } else {
                $sql = "SELECT id FROM categories WHERE name = :name";
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

    // Đếm tổng số danh mục
    public function countCategories()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['total'];
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return 0;
        }
    }
}