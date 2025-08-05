<?php require_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-box me-2"></i><?= $title ?></h2>
                <a href="index.php?act=product-create" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
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

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $totalProducts ?></h4>
                                    <p class="mb-0">Tổng sản phẩm</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-box fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $activeProducts ?></h4>
                                    <p class="mb-0">Đang hoạt động</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><?= $inactiveProducts ?></h4>
                                    <p class="mb-0">Ngừng hoạt động</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-pause-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>Tìm kiếm và lọc</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="index.php">
                        <input type="hidden" name="act" value="products">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="keyword" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" 
                                       value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" 
                                       placeholder="Tìm theo tên hoặc mô tả...">
                            </div>
                            <div class="col-md-3">
                                <label for="category_id" class="form-label">Danh mục</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Tất cả danh mục</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" 
                                                <?= ($_GET['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="active" <?= ($_GET['status'] ?? '') == 'active' ? 'selected' : '' ?>>Hoạt động</option>
                                    <option value="inactive" <?= ($_GET['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>Ngừng hoạt động</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-1"></i>Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($_GET['keyword']) || !empty($_GET['category_id']) || !empty($_GET['status'])): ?>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <a href="index.php?act=products" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-times me-1"></i>Xóa bộ lọc
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-table me-2"></i>Danh sách sản phẩm</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($products)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Không tìm thấy sản phẩm nào</h5>
                            <p class="text-muted">Hãy thêm sản phẩm đầu tiên hoặc thay đổi điều kiện tìm kiếm!</p>
                            <a href="index.php?act=product-create" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="10%">Hình ảnh</th>
                                        <th width="20%">Tên sản phẩm</th>
                                        <th width="15%">Danh mục</th>
                                        <th width="10%">Giá</th>
                                        <th width="8%">Kho</th>
                                        <th width="8%">Trạng thái</th>
                                        <th width="8%">Hot/Featured</th>
                                        <th width="16%" class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $index => $product): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <?php if (!empty($product['image'])): ?>
                                                    <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" 
                                                         class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?= htmlspecialchars($product['name']) ?></strong>
                                                <?php if (!empty($product['description'])): ?>
                                                    <br><small class="text-muted">
                                                        <?= htmlspecialchars(substr($product['description'], 0, 50)) ?>
                                                        <?= strlen($product['description']) > 50 ? '...' : '' ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($product['category_name'])): ?>
                                                    <span class="badge bg-info"><?= htmlspecialchars($product['category_name']) ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Chưa phân loại</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong class="text-success"><?= number_format($product['price'], 0, ',', '.') ?>đ</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $product['stock_quantity'] > 10 ? 'success' : ($product['stock_quantity'] > 0 ? 'warning' : 'danger') ?>">
                                                    <?= $product['stock_quantity'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $product['status'] == 'active' ? 'success' : 'secondary' ?>">
                                                    <?= $product['status'] == 'active' ? 'Hoạt động' : 'Ngừng' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($product['is_hot']): ?>
                                                    <span class="badge bg-danger mb-1">Hot</span><br>
                                                <?php endif; ?>
                                                <?php if ($product['is_featured']): ?>
                                                    <span class="badge bg-warning">Featured</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" 
                                                       class="btn btn-sm btn-info" title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="index.php?act=product-edit&id=<?= $product['id'] ?>" 
                                                       class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="index.php?act=product-delete&id=<?= $product['id'] ?>" 
                                                       class="btn btn-sm btn-danger" title="Xóa"
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm \'<?= htmlspecialchars($product['name']) ?>\' không?')">
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

.img-thumbnail {
    border-radius: 0.375rem;
}
</style>

<?php require_once PATH_VIEW . 'layouts/footer.php'; ?>