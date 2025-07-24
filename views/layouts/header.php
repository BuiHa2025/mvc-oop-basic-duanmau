<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="uploads/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

<!-- Header -->
<header>
    <div class="top-header">
        <div class="logo">
            <a href="index.php"><img src="upload/logo.png" alt="Logo"></a>
        </div>
        <div class="search-bar">
            <form action="#" method="GET" class="d-flex">
                <input type="text" name="keywoard" placeholder="Tìm kiếm sản phẩm..." class="form-control me-2">
                <button class="btn btn-danger">Tìm kiếm</button>
            </form>
        </div>
        <div class="header-actions d-flex align-items-center">
            <a href="?url=login">Đăng nhập</a>
            <a href="#"><i class="fas fa-shopping-cart fa-lg"></i>Giỏ hàng</a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="main-menu text-center">
        <a href="index.php">Trang chủ</a>
        <a href="?url=products">Rượu Vang</a>
        <a href="?url=products&type=ruou-manh">Rượu Mạnh</a>
        <a href="?url=news">Tin tức</a>
        <a href="?url=contact">Liên hệ</a>
    </nav>
</header>

<!-- MAIN CONTENT -->
<main class="container mt-3">
