<?php
// ArticleModel - Chứa các function thực thi tương tác với cơ sở dữ liệu cho bài viết
class ArticleModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả bài viết
    public function getAllArticles($status = 'published')
    {
        try {
            $sql = "SELECT * FROM articles WHERE status = :status ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy bài viết mới nhất
    public function getLatestArticles($limit = 5, $status = 'published')
    {
        try {
            $sql = "SELECT * FROM articles WHERE status = :status ORDER BY created_at DESC LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Lấy bài viết theo ID
    public function getArticleById($id)
    {
        try {
            $sql = "SELECT * FROM articles WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

    // Tạo bài viết mới
    public function createArticle($title, $content, $excerpt, $image, $author_id, $status = 'published')
    {
        try {
            $sql = "INSERT INTO articles (title, content, excerpt, image, author_id, status, created_at) 
                    VALUES (:title, :content, :excerpt, :image, :author_id, :status, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':excerpt', $excerpt);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật bài viết
    public function updateArticle($id, $title, $content, $excerpt, $image, $status = 'published')
    {
        try {
            $sql = "UPDATE articles SET title = :title, content = :content, excerpt = :excerpt, 
                    image = :image, status = :status, updated_at = NOW() WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':excerpt', $excerpt);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Xóa bài viết
    public function deleteArticle($id)
    {
        try {
            $sql = "DELETE FROM articles WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Tìm kiếm bài viết
    public function searchArticles($keyword, $status = 'published')
    {
        try {
            $sql = "SELECT * FROM articles WHERE status = :status AND (title LIKE :keyword OR content LIKE :keyword) 
                    ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Đếm tổng số bài viết
    public function countArticles($status = null)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM articles";
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

    // Tăng lượt xem bài viết
    public function incrementViews($id)
    {
        try {
            $sql = "UPDATE articles SET views = views + 1 WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}