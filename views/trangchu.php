
<?php include_once PATH_VIEW . 'layouts/header.php'; ?>

<!-- Banner -->
<div class="banner text-center my-4">
    <img src="uploads/about.jpg" alt="Banner" class="img-fluid w-100">
</div>

<div class="text-center my-4">
    <a href="index.php?act=register" class="btn btn-primary">Đăng ký</a>
</div>

<!-- Rượu HOT -->
<section class="container my-5">
    <h2 class="text-center">RƯỢU HOT</h2>
    <div class="row text-center mt-4">
        <?php if (!empty($hotProducts)): ?>
            <?php foreach ($hotProducts as $product): ?>
                <div class="col-md-3 mb-3">
                    <div class="border p-3">
                        <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Rượu HOT') ?>" class="img-fluid mb-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product['name'] ?? 'Rượu Vang Chile') ?>
                                </a>
                            </h5>
                            <p class="card-text text-danger fw-bold"><?= number_format($product['price'] ?? 1200000) ?>₫</p>
                            <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-dark mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-md-3 mb-3">
                    <div class="border p-3">
                        <img src="uploads/ruou<?= $i <= 2 ? 'A' : '2' ?>.jpg" alt="Rượu HOT <?= $i ?>" class="img-fluid mb-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="index.php?act=chitiet&id=<?= $i ?>" class="text-decoration-none text-dark">Rượu Vang Chile</a>
                            </h5>
                            <p class="card-text text-danger fw-bold">1.200.000₫</p>
                            <a href="index.php?act=chitiet&id=<?= $i ?>" class="btn btn-sm btn-outline-dark mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Rượu Mới -->
<section class="container my-5">
    <h2 class="text-center">Rượu Mới</h2>
    <div class="row text-center mt-4">
        <?php if (!empty($newProducts)): ?>
            <?php foreach ($newProducts as $product): ?>
                <div class="col-md-4 mb-3">
                    <div class="border p-3">
                        <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Rượu Mới') ?>" class="img-fluid mb-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product['name'] ?? 'Rượu Vang Chile') ?>
                                </a>
                            </h5>
                            <p class="card-text text-danger fw-bold"><?= number_format($product['price'] ?? 1200000) ?>₫</p>
                            <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-dark mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="col-md-4 mb-3">
                    <div class="border p-3">
                        <img src="uploads/ruou<?= $i <= 2 ? 'A' : '2' ?>.jpg" alt="Rượu Mới <?= $i ?>" class="img-fluid mb-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="index.php?act=chitiet&id=<?= $i ?>" class="text-decoration-none text-dark">Rượu Vang Chile</a>
                            </h5>
                            <p class="card-text text-danger fw-bold">1.200.000₫</p>
                            <a href="index.php?act=chitiet&id=<?= $i ?>" class="btn btn-sm btn-outline-dark mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div class="text-center mt-3">
        <a href="#" class="btn btn-light">Xem thêm sản phẩm</a>
    </div>
</section>

<!-- Rượu Nổi Bật -->
<section class="container my-5">
    <h2 class="text-center">Rượu Nổi Bật</h2>
    <div class="row text-center mt-4">
        <?php if (!empty($featuredProducts)): ?>
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-md-3 mb-3">
                    <div class="border p-3">
                        <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Rượu Nổi Bật') ?>" class="img-fluid mb-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product['name'] ?? 'Rượu Vang Chile') ?>
                                </a>
                            </h5>
                            <p class="card-text text-danger fw-bold"><?= number_format($product['price'] ?? 1200000) ?>₫</p>
                            <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-dark mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="col-md-3 mb-3">
                    <div class="border p-3">
                        <img src="uploads/ruou<?= $i <= 2 ? 'A' : '2' ?>.jpg" alt="Rượu Nổi Bật <?= $i ?>" class="img-fluid mb-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="index.php?act=chitiet&id=<?= $i ?>" class="text-decoration-none text-dark">Rượu Vang Chile</a>
                            </h5>
                            <p class="card-text text-danger fw-bold">1.200.000₫</p>
                            <a href="index.php?act=chitiet&id=<?= $i ?>" class="btn btn-sm btn-outline-dark mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div class="text-center mt-3">
        <a href="#" class="btn btn-light">Xem thêm sản phẩm</a>
    </div>
</section>

<!-- Tin tức -->
<section class="container my-5">
    <h2 class="text-center mb-4">Tin tức</h2>
    <div class="news-box border rounded p-4 shadow-sm">
        <div class="row g-4">
            <!-- Tin chính bên trái -->
            <div class="col-md-6">
                <div class="news-main">
                    <img src="uploads/about.jpg" alt="Tin chính" class="img-fluid rounded mb-3">
                    <h4 class="fw-bold">Khám phá thế giới rượu vang Chile</h4>
                    <p class="text-muted">Chile được biết đến là một trong những quốc gia sản xuất rượu vang chất lượng cao nhất thế giới với hương vị đặc trưng và giá cả hợp lý.</p>
                    <a href="#" class="btn btn-outline-danger btn-sm mt-2">Đọc thêm</a>
                </div>
            </div>

            <!-- 2 Tin phụ bên phải -->
            <div class="col-md-6">
                <div class="d-flex mb-3 border-bottom pb-2">
                    <img src="uploads/ruouA.jpg" alt="Tin phụ 1" class="img-thumbnail me-3" style="width: 100px; height: 70px; object-fit: cover;">
                    <div>
                        <h6 class="mb-1">Cách bảo quản rượu vang đúng cách</h6>
                        <p class="small text-muted mb-1">Hướng dẫn chi tiết cách bảo quản rượu vang để giữ được hương vị tốt nhất...</p>
                        <a href="#" class="text-danger small">Xem chi tiết</a>
                    </div>
                </div>
                
                <div class="d-flex mb-3 border-bottom pb-2">
                    <img src="uploads/ruou2.jpg" alt="Tin phụ 2" class="img-thumbnail me-3" style="width: 100px; height: 70px; object-fit: cover;">
                    <div>
                        <h6 class="mb-1">Top 5 loại rượu bán chạy nhất</h6>
                        <p class="small text-muted mb-1">Danh sách những loại rượu được khách hàng yêu thích và mua nhiều nhất...</p>
                        <a href="#" class="text-danger small">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút xem thêm -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-light">Xem thêm tin tức</a>
        </div>
    </div>
</section>

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>
