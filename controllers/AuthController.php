<?php

require_once 'models/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        // Khởi tạo session nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register() {
        $error = '';
        $success = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $email = trim($_POST['email'] ?? '');

            // Validate input
            if (empty($username) || empty($password) || empty($email)) {
                $error = "Vui lòng điền đầy đủ thông tin!";
            } elseif (strlen($password) < 6) {
                $error = "Mật khẩu phải có ít nhất 6 ký tự!";
            } elseif ($password !== $confirmPassword) {
                $error = "Mật khẩu xác nhận không khớp!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ!";
            } else {
                $result = $this->userModel->createUser($username, $password, $email);
                if ($result) {
                    $success = "Đăng ký thành công! Bạn có thể đăng nhập ngay bây giờ.";
                } else {
                    $error = "Tên đăng nhập hoặc email đã tồn tại!";
                }
            }
        }

        // Load giao diện đăng ký
        include_once PATH_VIEW . 'users/register.php';
    }

    public function login() {
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } else {
                $user = $this->userModel->findUser($username, $password);
                if ($user) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email']
                    ];
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                }
            }
        }
        
        // Load giao diện đăng nhập
        include_once PATH_VIEW . 'users/login.php';
    }

    public function logout()
    {
        // Hủy session
        session_start();
        session_unset();
        session_destroy();
        
        // Chuyển hướng về trang chủ
        header("Location: index.php");
        exit;
    }
}
