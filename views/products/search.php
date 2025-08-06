<?php include_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container my-4">
    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>Tìm kiếm sản phẩm</h5>
                </div>
                <div class="card-body">
                    <form action="index.php" method="GET" class="row g-3">
                        <input type="hidden" name="act" value="search">
                        
                        <div class="col-md-6">
                            <label for="keyword" class="form-label">Từ khóa</label>
                            <input type="text" class="form-control" id="keyword" name="keyword" 
                                   placeholder="Nhập tên sản phẩm..." value="<?= htmlspecialchars($keyword) ?>">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">Tất cả danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" 
                                            <?= ($category_id == $category['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-search me-1"></i>Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="row">
        <div class="col-12">
            <?php if (!empty($keyword) || !empty($category_id)): ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>
                        Kết quả tìm kiếm
                        <?php if (!empty($keyword)): ?>
                            cho "<strong><?= htmlspecialchars($keyword) ?></strong>"
                        <?php endif; ?>
                        <?php if (!empty($category_id)): ?>
                            <?php 
                            $selectedCategory = array_filter($categories, function($cat) use ($category_id) {
                                return $cat['id'] == $category_id;
                            });
                            if (!empty($selectedCategory)):
                                $selectedCategory = reset($selectedCategory);
                            ?>
                                trong danh mục "<strong><?= htmlspecialchars($selectedCategory['name']) ?></strong>"
                            <?php endif; ?>
                        <?php endif; ?>
                    </h4>
                    <span class="badge bg-secondary"><?= count($products) ?> sản phẩm</span>
                </div>

                <?php if (!empty($products)): ?>
                    <div class="row">
                        <?php foreach ($products as $product): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="position-relative">
                                        <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>" 
                                             class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>"
                                             style="height: 200px; object-fit: cover;">
                                        
                                        <?php if ($product['is_hot']): ?>
                                            <span class="position-absolute top-0 start-0 badge bg-danger m-2">HOT</span>
                                        <?php endif; ?>
                                        
                                        <?php if ($product['is_featured']): ?>
                                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">Nổi bật</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">
                                            <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" 
                                               class="text-decoration-none text-dark">
                                                <?= htmlspecialchars($product['name']) ?>
                                            </a>
                                        </h6>
                                        
                                        <?php if (!empty($product['category_name'])): ?>
                                            <small class="text-muted mb-2">
                                                <i class="fas fa-tag me-1"></i><?= htmlspecialchars($product['category_name']) ?>
                                            </small>
                                        <?php endif; ?>
                                        
                                        <p class="card-text text-muted small flex-grow-1">
                                            <?= htmlspecialchars(substr($product['description'] ?? '', 0, 100)) ?>
                                            <?= strlen($product['description'] ?? '') > 100 ? '...' : '' ?>
                                        </p>
                                        
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-danger fw-bold fs-6">
                                                    <?= number_format($product['price']) ?>₫
                                                </span>
                                                <small class="text-muted">
                                                    <i class="fas fa-box me-1"></i>Còn <?= $product['stock_quantity'] ?? 0 ?>
                                                </small>
                                            </div>
                                            <a href="index.php?act=chitiet&id=<?= $product['id'] ?>" 
                                               class="btn btn-outline-danger btn-sm w-100 mt-2">
                                                <i class="fas fa-eye me-1"></i>Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Không tìm thấy sản phẩm nào</h5>
                        <p class="text-muted">Vui lòng thử lại với từ khóa khác hoặc chọn danh mục khác.</p>
                        <a href="index.php" class="btn btn-primary">
                            <i class="fas fa-home me-1"></i>Về trang chủ
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Nhập từ khóa để tìm kiếm</h5>
                    <p class="text-muted">Sử dụng form tìm kiếm ở trên để tìm sản phẩm bạn muốn.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>