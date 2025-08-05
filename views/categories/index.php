<?php require_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-list me-2"></i><?= $title ?></h2>
                <a href="index.php?act=category-create" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                </a>
            </div>

            <!-- Alert Messages -->
            <?php if (!empty($message)): ?>
                <div class="alert alert-<?= $messageType === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-triangle' ?> me-2"></i>
                    <?= htmlspecialchars($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Statistics Card -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $totalCategories ?></h4>
                                    <p class="mb-0">Tổng danh mục</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-tags fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-table me-2"></i>Danh sách danh mục</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($categories)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Chưa có danh mục nào</h5>
                            <p class="text-muted">Hãy thêm danh mục đầu tiên của bạn!</p>
                            <a href="index.php?act=category-create" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Thêm danh mục mới
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="35%">Tên danh mục</th>
                                        <th width="45%">Mô tả</th>
                                        <th width="15%" class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $index => $category): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($category['name']) ?></strong>
                                            </td>
                                            <td>
                                                <?php if (!empty($category['description'])): ?>
                                                    <?= htmlspecialchars(substr($category['description'], 0, 100)) ?>
                                                    <?= strlen($category['description']) > 100 ? '...' : '' ?>
                                                <?php else: ?>
                                                    <em class="text-muted">Chưa có mô tả</em>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="index.php?act=category-show&id=<?= $category['id'] ?>" 
                                                       class="btn btn-sm btn-info" title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="index.php?act=category-edit&id=<?= $category['id'] ?>" 
                                                       class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="index.php?act=category-delete&id=<?= $category['id'] ?>" 
                                                       class="btn btn-sm btn-danger" title="Xóa"
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục \'<?= htmlspecialchars($category['name']) ?>\' không?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
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

.table th {
    border-top: none;
    font-weight: 600;
}

.btn-group .btn {
    margin: 0 1px;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}
</style>

<?php require_once PATH_VIEW . 'layouts/footer.php'; ?>