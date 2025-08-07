<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Trang chủ - Cửa hàng rượu' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="uploads/style.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Header -->
<header>
    <div class="top-header">
        <div class="logo">
            <a href="index.php">
                <img src="uploads/logo.jpg" alt="Logo" style="height: 50px; width: auto;">
            </a>
        </div>
        <div class="search-bar">
            <form action="index.php" method="GET" class="d-flex">
                <input type="hidden" name="act" value="search">
                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." class="form-control me-2" value="<?= $_GET['keyword'] ?? '' ?>">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
            </form>
        </div>
        <div class="header-actions d-flex align-items-center">
            <?php if (isset($_SESSION['user'])): ?>
                <!-- User đã đăng nhập -->
                <div class="dropdown me-3">
                    <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i>
                        Xin chào, <?= htmlspecialchars($_SESSION['user']['username']) ?>
                        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                            <span class="badge bg-danger ms-1">Admin</span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?act=profile">
                            <i class="fas fa-user-edit me-2"></i>Thông tin cá nhân
                        </a></li>
                        <li><a class="dropdown-item" href="index.php?act=orders">
                            <i class="fas fa-shopping-bag me-2"></i>Đơn hàng của tôi
                        </a></li>
                        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?act=categories">
                                <i class="fas fa-tags me-2"></i>Quản lý danh mục
                            </a></li>
                            <li><a class="dropdown-item" href="index.php?act=products">
                                <i class="fas fa-box me-2"></i>Quản lý sản phẩm
                            </a></li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="index.php?act=logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                        </a></li>
                    </ul>
                </div>
            <?php else: ?>
                <!-- User chưa đăng nhập -->
                <a href="index.php?act=login" class="me-3 text-decoration-none">
                    <i class="fas fa-user me-1"></i>Đăng nhập
                </a>
                <a href="index.php?act=register" class="me-3 text-decoration-none">
                    <i class="fas fa-user-plus me-1"></i>Đăng ký
                </a>
            <?php endif; ?>

            <a href="index.php?act=cart" class="position-relative text-decoration-none">
                <i class="fas fa-shopping-cart fa-lg me-1"></i>Giỏ hàng
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7em;">
                    <?php
                    $cartCount = 0;
                    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $cartCount += $item['quantity'];
                        }
                    }
                    echo $cartCount;
                    ?>
                </span>
            </a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="main-menu text-center">
        <a href="index.php" class="<?= (!isset($_GET['act']) || $_GET['act'] == '/') ? 'active' : '' ?>">
            <i class="fas fa-home me-1"></i>Trang chủ
        </a>
        
        <!-- Danh mục sản phẩm -->
        <div class="dropdown d-inline-block">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-wine-bottle me-1"></i>Danh mục sản phẩm
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?act=category&category_id=1">
                    <i class="fas fa-wine-glass me-2"></i>Rượu Vang
                </a></li>
                <li><a class="dropdown-item" href="index.php?act=category&category_id=2">
                    <i class="fas fa-glass-whiskey me-2"></i>Rượu Mạnh
                </a></li>
                <li><a class="dropdown-item" href="index.php?act=category&category_id=3">
                    <i class="fas fa-champagne-glasses me-2"></i>Rượu Sâm Panh
                </a></li>
                <li><a class="dropdown-item" href="index.php?act=category&category_id=4">
                    <i class="fas fa-seedling me-2"></i>Rượu Truyền Thống
                </a></li>
            </ul>
        </div>
        
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <!-- Admin-only navigation links -->
            <a href="index.php?act=categories" class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'categor') !== false) ? 'active' : '' ?>">
                <i class="fas fa-tags me-1"></i>Quản lý danh mục
            </a>
            <a href="index.php?act=products" class="<?= (isset($_GET['act']) && (strpos($_GET['act'], 'product') !== false || $_GET['act'] == 'products')) ? 'active' : '' ?>">
                <i class="fas fa-box me-1"></i>Quản lý sản phẩm
            </a>
        <?php endif; ?>
        
        <a href="index.php?act=news">
            <i class="fas fa-newspaper me-1"></i>Tin tức
        </a>
        <a href="index.php?act=contact">
            <i class="fas fa-phone me-1"></i>Liên hệ
        </a>
    </nav>
</header>

<!-- MAIN CONTENT -->
<main class="container-fluid mt-3">
