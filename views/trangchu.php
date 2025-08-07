<?php include_once PATH_VIEW . 'layouts/header.php'; ?>
<!-- Main Banners -->
<?php if (!empty($mainBanners)): ?>
<div class="banner-section my-4">
    <div id="mainBannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($mainBanners as $index => $banner): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <?php if (!empty($banner['link'])): ?>
                        <a href="<?= htmlspecialchars($banner['link']) ?>">
                    <?php endif; ?>
                    <img src="uploads/<?= $banner['image'] ?>?v=<?= time() ?>" class="d-block w-100" alt="<?= htmlspecialchars($banner['title']) ?>" style="height: 400px; object-fit: cover;">
                    <?php if (!empty($banner['link'])): ?>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($banner['title'])): ?>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= htmlspecialchars($banner['title']) ?></h5>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($mainBanners) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
<!-- Default Banner -->
<div class="banner text-center my-4">
    <img src="uploads/banner.jpg?v=<?= time() ?>" alt="Banner" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
</div>
<?php endif; ?>



<!-- Rượu HOT -->
<section class="container my-5">
    <h2 class="text-center mb-4">
        <i class="fas fa-fire text-danger me-2"></i>RƯỢU HOT
    </h2>
    <div class="row">
        <?php if (!empty($hotProducts)): ?>
            <?php foreach ($hotProducts as $product): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm product-card hot-product">
                        <div class="position-relative">
                            <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>?v=<?= time() ?>"
                                 class="card-img-top" alt="<?= htmlspecialchars($product['name'] ?? 'Rượu HOT') ?>"
                                 style="height: 250px; object-fit: cover;">
                            <span class="position-absolute top-0 start-0 badge bg-danger m-2">
                                <i class="fas fa-fire me-1"></i>HOT
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h6 class="card-title mb-2">
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product['name'] ?? 'Rượu Vang Chile') ?>
                                </a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                <?= htmlspecialchars(substr($product['description'] ?? '', 0, 80)) ?>
                                <?= strlen($product['description'] ?? '') > 80 ? '...' : '' ?>
                            </p>
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-2">
                                    <?= number_format($product['price'] ?? 1200000) ?>₫
                                </p>
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>"
                                   class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm product-card hot-product">
                        <div class="position-relative">
                            <img src="uploads/ruou<?= $i <= 2 ? 'A' : '2' ?>.jpg?v=<?= time() ?>"
                                 class="card-img-top" alt="Rượu HOT <?= $i ?>"
                                 style="height: 250px; object-fit: cover;">
                            <span class="position-absolute top-0 start-0 badge bg-danger m-2">
                                <i class="fas fa-fire me-1"></i>HOT
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h6 class="card-title mb-2">
                                <a href="index.php?act=chitiet&id=<?= $i ?>" class="text-decoration-none text-dark">
                                    Rượu Vang Chile
                                </a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                Rượu vang đỏ Chile với hương vị đậm đà, tannin mềm mại
                            </p>
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-2">1.200.000₫</p>
                                <a href="index.php?act=chitiet&id=<?= $i ?>"
                                   class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Rượu Mới -->
<section class="container my-5">
    <h2 class="text-center mb-4">
        <i class="fas fa-star text-warning me-2"></i>RƯỢU MỚI
    </h2>
    <div class="row">
        <?php if (!empty($newProducts)): ?>
            <?php foreach ($newProducts as $product): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm product-card new-product">
                        <div class="position-relative">
                            <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>?v=<?= time() ?>"
                                 class="card-img-top wine-bottle-img" alt="<?= htmlspecialchars($product['name'] ?? 'Rượu Mới') ?>"
                                 style="height: 280px; object-fit: cover;">
                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">
                                <i class="fas fa-star me-1"></i>MỚI
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h6 class="card-title mb-2">
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product['name'] ?? 'Rượu Vang Chile') ?>
                                </a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                <?= htmlspecialchars(substr($product['description'] ?? '', 0, 80)) ?>
                                <?= strlen($product['description'] ?? '') > 80 ? '...' : '' ?>
                            </p>
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-2">
                                    <?= number_format($product['price'] ?? 1200000) ?>₫
                                </p>
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>"
                                   class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm product-card new-product">
                        <div class="position-relative">
                            <img src="uploads/ruou<?= $i <= 2 ? 'A' : '2' ?>.jpg?v=<?= time() ?>"
                                 class="card-img-top wine-bottle-img" alt="Rượu Mới <?= $i ?>"
                                 style="height: 280px; object-fit: cover;">
                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">
                                <i class="fas fa-star me-1"></i>MỚI
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h6 class="card-title mb-2">
                                <a href="index.php?act=chitiet&id=<?= $i ?>" class="text-decoration-none text-dark">
                                    Rượu Vang Chile
                                </a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                Rượu vang đỏ Chile với hương vị đậm đà, tannin mềm mại
                            </p>
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-2">1.200.000₫</p>
                                <a href="index.php?act=chitiet&id=<?= $i ?>"
                                   class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div class="text-center mt-4">
        <a href="#" class="btn btn-outline-secondary">
            <i class="fas fa-plus me-1"></i>Xem thêm sản phẩm
        </a>
    </div>
</section>

<!-- Rượu Nổi Bật -->
<section class="container my-5">
    <h2 class="text-center mb-4">
        <i class="fas fa-crown text-warning me-2"></i>RƯỢU NỔI BẬT
    </h2>
    <div class="row">
        <?php if (!empty($featuredProducts)): ?>
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm product-card featured-product">
                        <div class="position-relative">
                            <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>?v=<?= time() ?>"
                                 class="card-img-top wine-bottle-img" alt="<?= htmlspecialchars($product['name'] ?? 'Rượu Nổi Bật') ?>"
                                 style="height: 260px; object-fit: cover;">
                            <span class="position-absolute top-0 start-0 badge bg-gradient bg-warning text-dark m-2">
                                <i class="fas fa-crown me-1"></i>NỔI BẬT
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h6 class="card-title mb-2">
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product['name'] ?? 'Rượu Vang Chile') ?>
                                </a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                <?= htmlspecialchars(substr($product['description'] ?? '', 0, 70)) ?>
                                <?= strlen($product['description'] ?? '') > 70 ? '...' : '' ?>
                            </p>
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-2">
                                    <?= number_format($product['price'] ?? 1200000) ?>₫
                                </p>
                                <a href="index.php?act=chitiet&id=<?= $product['id'] ?>"
                                   class="btn btn-outline-warning btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm product-card featured-product">
                        <div class="position-relative">
                            <img src="uploads/ruou<?= $i <= 2 ? 'A' : '2' ?>.jpg?v=<?= time() ?>"
                                 class="card-img-top wine-bottle-img" alt="Rượu Nổi Bật <?= $i ?>"
                                 style="height: 260px; object-fit: cover;">
                            <span class="position-absolute top-0 start-0 badge bg-gradient bg-warning text-dark m-2">
                                <i class="fas fa-crown me-1"></i>NỔI BẬT
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h6 class="card-title mb-2">
                                <a href="index.php?act=chitiet&id=<?= $i ?>" class="text-decoration-none text-dark">
                                    Rượu Vang Chile
                                </a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">
                                Rượu vang đỏ Chile với hương vị đậm đà, tannin mềm mại
                            </p>
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-2">1.200.000₫</p>
                                <a href="index.php?act=chitiet&id=<?= $i ?>"
                                   class="btn btn-outline-warning btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div class="text-center mt-4">
        <a href="#" class="btn btn-outline-secondary">
            <i class="fas fa-plus me-1"></i>Xem thêm sản phẩm
        </a>
    </div>
</section>

<!-- Tin tức -->
<section class="container my-5">
    <h2 class="text-center mb-4">Tin tức mới nhất</h2>
    <?php if (!empty($latestArticles)): ?>
        <div class="news-box border rounded p-4 shadow-sm">
            <div class="row g-4">
                <?php if (count($latestArticles) > 0): ?>
                    <!-- Tin chính bên trái -->
                    <div class="col-md-6">
                        <div class="news-main">
                            <?php $mainArticle = $latestArticles[0]; ?>
                            <img src="uploads/<?= $mainArticle['image'] ?? 'about.jpg' ?>?v=<?= time() ?>" alt="<?= htmlspecialchars($mainArticle['title']) ?>" class="img-fluid rounded mb-3" style="height: 250px; width: 100%; object-fit: cover;">
                            <h4 class="fw-bold">
                                <a href="index.php?act=article&id=<?= $mainArticle['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($mainArticle['title']) ?>
                                </a>
                            </h4>
                            <p class="text-muted">
                                <?= htmlspecialchars($mainArticle['excerpt'] ?? substr($mainArticle['content'], 0, 150) . '...') ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <?= date('d/m/Y', strtotime($mainArticle['created_at'])) ?>
                                </small>
                                <a href="index.php?act=article&id=<?= $mainArticle['id'] ?>" class="btn btn-outline-danger btn-sm">Đọc thêm</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tin phụ bên phải -->
                    <div class="col-md-6">
                        <?php for ($i = 1; $i < count($latestArticles) && $i <= 2; $i++): ?>
                            <?php $article = $latestArticles[$i]; ?>
                            <div class="d-flex mb-3 border-bottom pb-2">
                                <img src="uploads/<?= $article['image'] ?? 'ruouA.jpg' ?>?v=<?= time() ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="img-thumbnail me-3" style="width: 100px; height: 70px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="index.php?act=article&id=<?= $article['id'] ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($article['title']) ?>
                                        </a>
                                    </h6>
                                    <p class="small text-muted mb-1">
                                        <?= htmlspecialchars(substr($article['excerpt'] ?? $article['content'], 0, 80) . '...') ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                                        </small>
                                        <a href="index.php?act=article&id=<?= $article['id'] ?>" class="text-danger small">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Nút xem thêm -->
            <div class="text-center mt-4">
                <a href="index.php?act=news" class="btn btn-light">Xem thêm tin tức</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Fallback content when no articles -->
        <div class="news-box border rounded p-4 shadow-sm">
            <div class="row g-4">
                <!-- Tin chính bên trái -->
                <div class="col-md-6">
                    <div class="news-main">
                        <img src="uploads/about.jpg?v=<?= time() ?>" alt="Tin chính" class="img-fluid rounded mb-3">
                        <h4 class="fw-bold">Khám phá thế giới rượu vang Chile</h4>
                        <p class="text-muted">Chile được biết đến là một trong những quốc gia sản xuất rượu vang chất lượng cao nhất thế giới với hương vị đặc trưng và giá cả hợp lý.</p>
                        <a href="#" class="btn btn-outline-danger btn-sm mt-2">Đọc thêm</a>
                    </div>
                </div>

                <!-- 2 Tin phụ bên phải -->
                <div class="col-md-6">
                    <div class="d-flex mb-3 border-bottom pb-2">
                        <img src="uploads/ruouA.jpg?v=<?= time() ?>" alt="Tin phụ 1" class="img-thumbnail me-3" style="width: 100px; height: 70px; object-fit: cover;">
                        <div>
                            <h6 class="mb-1">Cách bảo quản rượu vang đúng cách</h6>
                            <p class="small text-muted mb-1">Hướng dẫn chi tiết cách bảo quản rượu vang để giữ được hương vị tốt nhất...</p>
                            <a href="#" class="text-danger small">Xem chi tiết</a>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3 border-bottom pb-2">
                        <img src="uploads/ruou2.jpg?v=<?= time() ?>" alt="Tin phụ 2" class="img-thumbnail me-3" style="width: 100px; height: 70px; object-fit: cover;">
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
                <a href="index.php?act=news" class="btn btn-light">Xem thêm tin tức</a>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>
