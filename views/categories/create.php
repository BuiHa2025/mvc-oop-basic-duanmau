<?php require_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-plus me-2"></i><?= $title ?></h2>
                <a href="index.php?act=categories" class="btn btn-secondary">
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
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Thông tin danh mục</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php?act=category-create">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-tag me-1"></i>Tên danh mục <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control <?= !empty($error) && strpos($error, 'Tên danh mục') !== false ? 'is-invalid' : '' ?>" 
                                   id="name" 
                                   name="name" 
                                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                                   placeholder="Nhập tên danh mục..."
                                   required
                                   maxlength="255">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>Tên danh mục phải có ít nhất 2 ký tự và không được trùng lặp.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>Mô tả
                            </label>
                            <textarea class="form-control" 
                                      id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Nhập mô tả cho danh mục..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>Mô tả chi tiết về danh mục này (tùy chọn).
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php?act=categories" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-2"></i>Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Lưu danh mục
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
                        <li><strong>Tên danh mục:</strong> Bắt buộc, ít nhất 2 ký tự, không được trùng lặp.</li>
                        <li><strong>Mô tả:</strong> Tùy chọn, giúp mô tả chi tiết về danh mục.</li>
                        <li>Sau khi tạo thành công, bạn sẽ được chuyển về danh sách danh mục.</li>
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

.form-control:focus {
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
</style>

<script>
// Auto-focus on name field
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('name').focus();
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    
    if (name.length < 2) {
        e.preventDefault();
        alert('Tên danh mục phải có ít nhất 2 ký tự!');
        document.getElementById('name').focus();
        return false;
    }
});
</script>

<?php require_once PATH_VIEW . 'layouts/footer.php'; ?>