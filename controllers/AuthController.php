<?php

require_once 'models/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                echo "Tên người dùng và mật khẩu là bắt buộc.";
                return;
            }

            if ($this->userModel->createUser($username, $password)) {
                echo "Đăng ký thành công! Bây giờ bạn có thể đăng nhập.";
                // Tùy chọn chuyển hướng đến trang đăng nhập
                // header('Location: /login');
                // exit();
            } else {
                echo "Đăng ký thất bại. Tên người dùng có thể đã tồn tại.";
            }
        } else {
            include 'views/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                echo "Tên người dùng và mật khẩu là bắt buộc.";
                return;
            }

            if ($this->userModel->findUser($username, $password)) {
                echo "Đăng nhập thành công!";
                // Tùy chọn chuyển hướng đến trang tổng quan hoặc trang chủ
                // header('Location: /');
                // exit();
            } else {
                echo "Đăng nhập thất bại. Tên người dùng hoặc mật khẩu không hợp lệ.";
            }
        }
        else {
            include 'views/login.php';
        }
    }

    public function logout()
    {
        echo "Đăng xuất thành công!";
        // Logic để hủy phiên
    }
}