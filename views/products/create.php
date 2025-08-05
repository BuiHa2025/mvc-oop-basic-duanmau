<?php require_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-plus me-2"></i><?= $title ?></h2>
                <a href="index.php?act=products" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <!-- Error Alert -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Create Form -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php?act=product-create" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Basic Information -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-tag me-1"></i>Tên sản phẩm <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?= !empty($error) && strpos($error, 'Tên sản phẩm') !== false ? 'is-invalid' : '' ?>" 
                                           id="name" 
                                           name="name" 
                                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                                           placeholder="Nhập tên sản phẩm..."
                                           required
                                           maxlength="255">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left me-1"></i>Mô tả sản phẩm
                                    </label>
                                    <textarea class="form-control" 
                                              id="description" 
                                              name="description" 
                                              rows="4"
                                              placeholder="Nhập mô tả chi tiết về sản phẩm..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">
                                                <i class="fas fa-money-bill me-1"></i>Giá bán <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="number" 
                                                       class="form-control <?= !empty($error) && strpos($error, 'Giá') !== false ? 'is-invalid' : '' ?>" 
                                                       id="price" 
                                                       name="price" 
                                                       value="<?= $_POST['price'] ?? '' ?>"
                                                       placeholder="0"
                                                       min="0"
                                                       step="1000"
                                                       required>
                                                <span class="input-group-text">VNĐ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock_quantity" class="form-label">
                                                <i class="fas fa-boxes me-1"></i>Số lượng tồn kho
                                            </label>
                                            <input type="number" 
                                                   class="form-control" 
                                                   id="stock_quantity" 
                                                   name="stock_quantity" 
                                                   value="<?= $_POST['stock_quantity'] ?? '0' ?>"
                                                   placeholder="0"
                                                   min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">
                                        <i class="fas fa-list me-1"></i>Danh mục
                                    </label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Chọn danh mục</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['id'] ?>" 
                                                    <?= ($_POST['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($category['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Image Upload -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">
                                        <i class="fas fa-image me-1"></i>Hình ảnh sản phẩm
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Chọn file hình ảnh (JPG, PNG, GIF)
                                    </div>
                                    <div id="imagePreview" class="mt-2" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                </div>

                                <!-- Status and Options -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-toggle-on me-1"></i>Trạng thái
                                    </label>
                                    <select class="form-select" name="status">
                                        <option value="active" <?= ($_POST['status'] ?? 'active') == 'active' ? 'selected' : '' ?>>
                                            Hoạt động
                                        </option>
                                        <option value="inactive" <?= ($_POST['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>
                                            Ngừng hoạt động
                                        </option>
                                    </select>
                                </div>

                                <!-- Special Options -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-star me-1"></i>Tùy chọn đặc biệt
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_hot" name="is_hot" 
                                               <?= isset($_POST['is_hot']) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_hot">
                                            <span class="badge bg-danger">Hot</span> Sản phẩm hot
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                               <?= isset($_POST['is_featured']) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_featured">
                                            <span class="badge bg-warning">Featured</span> Sản phẩm nổi bật
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php?act=products" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-2"></i>Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Lưu sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-question-circle me-2"></i>Hướng dẫn</h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li><strong>Tên sản phẩm:</strong> Bắt buộc, ít nhất 2 ký tự, không được trùng lặp.</li>
                        <li><strong>Giá bán:</strong> Bắt buộc, phải lớn hơn 0.</li>
                        <li><strong>Hình ảnh:</strong> Tùy chọn, chỉ chấp nhận file JPG, PNG, GIF.</li>
                        <li><strong>Danh mục:</strong> Tùy chọn, giúp phân loại sản phẩm.</li>
                        <li><strong>Hot/Featured:</strong> Sản phẩm sẽ hiển thị ở vị trí đặc biệt trên trang chủ.</li>
                    </ul>
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

.form-label {
    font-weight: 600;
    color: #495057;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.btn {
    border-radius: 0.375rem;
}

.img-thumbnail {
    border-radius: 0.375rem;
}
</style>

<script>
// Auto-focus on name field
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('name').focus();
});

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value;
    
    if (name.length < 2) {
        e.preventDefault();
        alert('Tên sản phẩm phải có ít nhất 2 ký tự!');
        document.getElementById('name').focus();
        return false;
    }
    
    if (price <= 0) {
        e.preventDefault();
        alert('Giá sản phẩm phải lớn hơn 0!');
        document.getElementById('price').focus();
        return false;
    }
});

// Format price input
document.getElementById('price').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});
</script>

<?php require_once PATH_VIEW . 'layouts/footer.php'; ?>