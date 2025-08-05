<?php require_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-eye me-2"></i><?= $title ?></h2>
                <div>
                    <a href="index.php?act=categories" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <a href="index.php?act=category-edit&id=<?= $category['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa
                    </a>
                </div>
            </div>

            <!-- Category Details -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin chi tiết</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong><i class="fas fa-hashtag me-1"></i>ID:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="badge bg-primary"><?= $category['id'] ?></span>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <strong><i class="fas fa-tag me-1"></i>Tên danh mục:</strong>
                        </div>
                        <div class="col-md-9">
                            <h5 class="text-primary mb-0"><?= htmlspecialchars($category['name']) ?></h5>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <strong><i class="fas fa-align-left me-1"></i>Mô tả:</strong>
                        </div>
                        <div class="col-md-9">
                            <?php if (!empty($category['description'])): ?>
                                <p class="mb-0"><?= nl2br(htmlspecialchars($category['description'])) ?></p>
                            <?php else: ?>
                                <em class="text-muted">Chưa có mô tả</em>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-cogs me-2"></i>Thao tác</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="index.php?act=categories" class="btn btn-secondary">
                            <i class="fas fa-list me-2"></i>Danh sách danh mục
                        </a>
                        <a href="index.php?act=category-edit&id=<?= $category['id'] ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa
                        </a>
                        <a href="index.php?act=category-create" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                        </a>
                        <a href="index.php?act=category-delete&id=<?= $category['id'] ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục \'<?= htmlspecialchars($category['name']) ?>\' không?\n\nHành động này không thể hoàn tác!')">
                            <i class="fas fa-trash me-2"></i>Xóa danh mục
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Card (Optional - for future enhancement) -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Thống kê</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="text-primary">0</h4>
                                    <small class="text-muted">Sản phẩm trong danh mục</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card hr {
    margin: 1rem 0;
    opacity: 0.3;
}

.btn {
    border-radius: 0.375rem;
}

.badge {
    font-size: 0.9em;
}
</style>

<?php require_once PATH_VIEW . 'layouts/footer.php'; ?>