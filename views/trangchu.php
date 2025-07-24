
    <?php include_once PATH_VIEW . 'layouts/header.php'; ?>

<!-- Banner -->
<div class="banner text-center my-4">
    <img src="upload/banner.jpg" alt="Banner" class="img-fluid w-100">
</div>

<!-- Rượu HOT -->
<section class="container my-5">
    <h2 class="text-center">RƯỢU HOT</h2>
    <div class="row text-center mt-4">
        <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="col-md-3">
                <img src="upload/ruou<?= $i ?>.jpg" alt="Rượu HOT <?= $i ?>" class="img-fluid mb-2">
            </div>
        <?php endfor; ?>
    </div>
</section>

<!-- Rượu Mới -->
<section class="container my-5">
    <h2 class="text-center">Rượu Mới</h2>
    <div class="row text-center mt-4">
        <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="col-md-4 mb-3">
                <div class="border p-3">
                    <img src="upload/ruou<?= $i ?>.jpg" class="img-fluid mb-2">
                    <p>Tên SP</p>
                    <p>Giá SP</p>
                    <a href="#" class="text-danger">Mua</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="text-center mt-3">
        <a href="#" class="btn btn-light">Xem thêm sản phẩm</a>
    </div>
</section>

<!-- Rượu Nổi Bật -->
<section class="container my-5">
    <h2 class="text-center">Rượu Nổi Bật</h2>
    <div class="row text-center mt-4">
        <?php for ($i = 1; $i <= 8; $i++): ?>
            <div class="col-md-3 mb-3">
                <div class="border p-3">
                    <img src="upload/ruou<?= $i ?>.jpg" class="img-fluid mb-2">
                    <p>Tên SP</p>
                    <p>Giá SP</p>
                    <a href="#" class="text-danger">Mua</a>
                </div>
            </div>
        <?php endfor; ?>
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
                    <img src="upload/news1.jpg" alt="Tin chính" class="img-fluid rounded mb-3">
                    <h4 class="fw-bold">Tiêu đề tin chính</h4>
                    <p class="text-muted">Tóm tắt nội dung nổi bật của tin tức chính. Đây là phần ngắn gọn mô tả tin tức.</p>
                    <a href="#" class="btn btn-outline-danger btn-sm mt-2">Đọc thêm</a>
                </div>
            </div>

            <!-- 2 Tin phụ bên phải -->
            <div class="col-md-6">
                <?php for ($i = 2; $i <= 3; $i++): ?>
                    <div class="d-flex mb-3 border-bottom pb-2">
                        <img src="upload/news<?= $i ?>.jpg" alt="Tin phụ <?= $i ?>" class="img-thumbnail me-3" style="width: 100px; height: 70px; object-fit: cover;">
                        <div>
                            <h6 class="mb-1">Tiêu đề tin phụ <?= $i ?></h6>
                            <p class="small text-muted mb-1">Tóm tắt nội dung tin tức <?= $i ?>...</p>
                            <a href="#" class="text-danger small">Xem chi tiết</a>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        
</section>

<!-- Nút xem thêm -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-light">Xem thêm tin tức</a>
        </div>
    </div>
<!-- Footer (nằm trong layouts/footer.php) -->

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>