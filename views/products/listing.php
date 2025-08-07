<?php include_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container my-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
                </ol>
            </nav>
            <h1 class="h2 mb-3">
                <i class="fas fa-boxes me-2 text-danger"></i>
                Tất cả sản phẩm
            </h1>
            <p class="text-muted">Khám phá toàn bộ danh sách sản phẩm của chúng tôi</p>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Categories -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Danh mục sản phẩm</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="index.php?act=products-listing" class="list-group-item list-group-item-action active">
                            <i class="fas fa-boxes me-2"></i>Tất cả sản phẩm
                            <span class="badge bg-secondary float-end"><?= count($products) ?></span>
                        </a>
                        <?php foreach ($categories as $category): ?>
                            <a href="index.php?act=category&category_id=<?= $category['id'] ?>" 
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-wine-bottle me-2"></i>
                                <?= htmlspecialchars($category['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-search me-2"></i>Tìm kiếm sản phẩm</h6>
                </div>
                <div class="card-body">
                    <form action="index.php" method="GET">
                        <input type="hidden">
="act" value="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" 
                                   placeholder="Nhập từ khóa..." value="<?= $_GET['keyword'] ?? '' ?>">
                            <button class="btn btn-outline-danger" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-lg-9 col-md-8">
            <!-- Results Info -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    Danh sách sản phẩm
                    <span class="badge bg-secondary"><?= count($products) ?> sản phẩm</span>
                </h4>
                
                <!-- Sort Options -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-sort me-1"></i>Sắp xếp
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?act=products-listing&sort=name_asc">Tên A-Z</a></li>
                        <li><a class="dropdown-item" href="?act=products-listing&sort=name_desc">Tên Z-A</a></li>
                        <li><a class="dropdown-item" href="?act=products-listing&sort=price_asc">Giá thấp đến cao</a></li>
                        <li><a class="dropdown-item" href="?act=products-listing&sort=price_desc">Giá cao đến thấp</a></li>
                        <li><a class="dropdown-item" href="?act=products-listing&sort=newest">Mới nhất</a></li>
                    </ul>
                </div>
            </div>

            <?php if (!empty($products)): ?>
                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm product-card">
                                <div class="position-relative">
                                    <img src="<?= !empty($product['image']) ? $product['image'] : 'uploads/ruouA.jpg' ?>" 
                                         class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>"
                                         style="height: 250px; object-fit: cover;">
                                    
                                    <?php if ($product['is_hot']): ?>
                                        <span class="position-absolute top-0 start-0 badge bg-danger m-2">
                                            <i class="fas fa-fire me-1"></i>HOT
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if ($product['is_featured']): ?>
                                        <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">
                                            <i class="fas fa-star me-1"></i>Nổi bật
                                        </span>
                                    <?php endif; ?>

                                    <?php if (($product['stock_quantity'] ?? 0) <= 0): ?>
                                        <div class="position-absolute top-50 start-50 translate-middle">
                                            <span class="badge bg-dark fs-6">Hết hàng</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">
                                        <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" 
                                           class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h6>
                                    
                                    <p class="card-text text-muted small flex-grow-1">
                                        <?= htmlspecialchars(substr($product['description'] ?? '', 0, 100)) ?>
                                        <?= strlen($product['description'] ?? '') > 100 ? '...' : '' ?>
                                    </p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-danger fw-bold fs-5">
                                                <?= number_format($product['price']) ?>₫
                                            </span>
                                            <small class="text-muted">
                                                <i class="fas fa-box me-1"></i>
                                                <?php if (($product['stock_quantity'] ?? 0) > 0): ?>
                                                    Còn <?= $product['stock_quantity'] ?>
                                                <?php else: ?>
                                                    <span class="text-danger">Hết hàng</span>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                        
                                        <div class="d-grid gap-2">
                                            <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" 
                                               class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-eye me-1"></i>Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination placeholder -->
                <nav aria-label="Product pagination" class="mt-4">
                    <div class="d-flex justify-content-center">
                        <small class="text-muted">Hiển thị <?= count($products) ?> sản phẩm</small>
                    </div>
                </nav>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Không có sản phẩm nào</h5>
                    <p class="text-muted">Hiện tại chưa có sản phẩm nào trong cửa hàng.</p>
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-home me-1"></i>Về trang chủ
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.list-group-item.active {
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>