<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderSave){
    $file_upload = $file;
    $pathStorage = $folderSave . rand(10000, 99999) . $file_upload['name'];

    $tmp_file = $file_upload['tmp_name'];
    $pathSave = PATH_ROOT . $pathStorage; // Đường dãn tuyệt đối của file

    if (move_uploaded_file($tmp_file, $pathSave)) {
        return $pathStorage;
    }
    return null;
}

function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete); // Hàm unlink dùng để xóa file
    }
}

// Kiểm tra xem user đã đăng nhập chưa
function isLoggedIn() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
}

// Kiểm tra xem user có phải admin không
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
}

// Kiểm tra quyền truy cập admin, nếu không phải admin thì chuyển về trang chủ
function requireAdmin() {
    if (!isAdmin()) {
        $_SESSION['message'] = "Bạn không có quyền truy cập vào trang này!";
        $_SESSION['message_type'] = "error";
        header('Location: index.php');
        exit();
    }
}

// Kiểm tra đăng nhập, nếu chưa đăng nhập thì chuyển về trang đăng nhập
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php?act=login');
        exit();
    }
}

// Lấy thông tin user hiện tại
function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}

// Lấy role của user hiện tại
function getCurrentUserRole() {
    return $_SESSION['user']['role'] ?? 'guest';
}
