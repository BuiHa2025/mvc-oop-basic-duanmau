<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập / Đăng ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .toggle-form {
            margin-top: 20px;
            color: #007bff;
            cursor: pointer;
        }

        .toggle-form:hover {
            text-decoration: underline;
        }

        #login-form,
        #register-form {
            display: none;
            /* Hidden by default, will be shown by JS */
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="login-form">
            <h2>Đăng nhập</h2>
            <form action="/login" method="POST">
                <div class="form-group">
                    <label for="login-email">Email:</label>
                    <input type="email" id="login-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Mật khẩu:</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                <button type="submit" class="btn">Đăng nhập</button>
            </form>
            <p class="toggle-form" onclick="showRegisterForm()">Chưa có tài khoản? Đăng ký ngay!</p>
        </div>

        <div id="register-form">
            <h2>Đăng ký</h2>
            <form action="/register" method="POST">
                <div class="form-group">
                    <label for="register-username">Tên người dùng:</label>
                    <input type="text" id="register-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email:</label>
                    <input type="email" id="register-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Mật khẩu:</label>
                    <input type="password" id="register-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="register-confirm-password">Xác nhận mật khẩu:</label>
                    <input type="password" id="register-confirm-password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn">Đăng ký</button>
            </form>
            <p class="toggle-form" onclick="showLoginForm()">Đã có tài khoản? Đăng nhập!</p>
        </div>
    </div>

    <script>
        function showLoginForm() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
        }

        function showRegisterForm() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }

        // Show login form by default when page loads
        document.addEventListener('DOMContentLoaded', showLoginForm);
    </script>
</body>

</html>