<?php
// BannerModel - Chứa các function thực thi tương tác với cơ sở dữ liệu cho banner
class BannerModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả banner theo vị trí
    public function getBannersByPosition($position = null, $status = 'active')
    {
        try {
            $sql = "SELECT * FROM banners WHERE status = :status";
            $params = [':status' => $status];
            
            if ($position) {
                $sql .= " AND position = :position";
                $params[':position'] = $position;
            }
            
            $sql .= " ORDER BY sort_order ASC, id DESC";
            
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

    // Lấy banner theo ID
    public function getBannerById($id)
    {
        try {
            $sql = "SELECT * FROM banners WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

    // Tạo banner mới
    public function createBanner($title, $image, $link, $position, $sort_order = 0, $status = 'active')
    {
        try {
            $sql = "INSERT INTO banners (title, image, link, position, sort_order, status) 
                    VALUES (:title, :image, :link, :position, :sort_order, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật banner
    public function updateBanner($id, $title, $image, $link, $position, $sort_order = 0, $status = 'active')
    {
        try {
            $sql = "UPDATE banners SET title = :title, image = :image, link = :link, 
                    position = :position, sort_order = :sort_order, status = :status 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Xóa banner
    public function deleteBanner($id)
    {
        try {
            $sql = "DELETE FROM banners WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Lấy tất cả banner
    public function getAllBanners()
    {
        try {
            $sql = "SELECT * FROM banners ORDER BY position ASC, sort_order ASC, id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Đếm tổng số banner
    public function countBanners($status = null)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM banners";
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
}