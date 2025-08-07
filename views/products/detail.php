<?php include_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <div class="product-image">
                <?php if (isset($product) && !empty($product)): ?>
                    <img src="uploads/<?= $product['image'] ?? 'ruouA.jpg' ?>?v=<?= time() ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Sản phẩm') ?>" class="img-fluid rounded shadow">
                <?php else: ?>
                    <img src="uploads/ruouA.jpg?v=<?= time() ?>" alt="Rượu ngon" class="img-fluid rounded shadow">
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-info">
                <?php if (isset($product) && !empty($product)): ?>
                    <h2 class="mb-3"><?= htmlspecialchars($product['name'] ?? 'Rượu Vang Đỏ Chile') ?></h2>
                    <div class="price mb-3">
                        <span class="h4 text-danger fw-bold"><?= number_format($product['price'] ?? 1200000) ?>₫</span>
                    </div>
                    <div class="product-details mb-4">
                        <p><strong>Mô tả:</strong></p>
                        <p class="text-muted"><?= htmlspecialchars($product['description'] ?? 'Hương vị đậm đà, thích hợp cho các bữa tiệc sang trọng hoặc làm quà tặng.') ?></p>
                        
                        <?php if (isset($product['category'])): ?>
                            <p><strong>Danh mục:</strong> <span class="badge bg-secondary"><?= htmlspecialchars($product['category']) ?></span></p>
                        <?php endif; ?>
                        
                        <?php if (isset($product['alcohol_content'])): ?>
                            <p><strong>Độ cồn:</strong> <?= htmlspecialchars($product['alcohol_content']) ?>%</p>
                        <?php endif; ?>
                        
                        <?php if (isset($product['origin'])): ?>
                            <p><strong>Xuất xứ:</strong> <?= htmlspecialchars($product['origin']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <h2 class="mb-3">Rượu Vang Đỏ Chile</h2>
                    <div class="price mb-3">
                        <span class="h4 text-danger fw-bold">1.200.000₫</span>
                    </div>
                    <div class="product-details mb-4">
                        <p><strong>Mô tả:</strong></p>
                        <p class="text-muted">Hương vị đậm đà, thích hợp cho các bữa tiệc sang trọng hoặc làm quà tặng.</p>
                        <p><strong>Danh mục:</strong> <span class="badge bg-secondary">Rượu Vang</span></p>
                        <p><strong>Độ cồn:</strong> 13.5%</p>
                        <p><strong>Xuất xứ:</strong> Chile</p>
                    </div>
                <?php endif; ?>
                
                <div class="product-actions">
                    <div class="quantity-selector mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                            <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="10">
                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn btn-danger btn-lg me-2" onclick="addToCart()">
                            <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ hàng
                        </button>
                        <button class="btn btn-outline-danger btn-lg" onclick="buyNow()">
                            Mua ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sản phẩm liên quan -->
    <div class="related-products mt-5">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="row">
            <?php if (isset($relatedProducts) && !empty($relatedProducts)): ?>
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="uploads/<?= $relatedProduct['image'] ?? 'ruouA.jpg' ?>?v=<?= time() ?>" class="card-img-top" alt="<?= htmlspecialchars($relatedProduct['name']) ?>">
                            <div class="card-body text-center">
                                <h6 class="card-title">
                                    <a href="index.php?act=chitiet&id=<?= $relatedProduct['id'] ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($relatedProduct['name']) ?></a>
                                </h6>
                                <p class="card-text text-danger fw-bold"><?= number_format($relatedProduct['price']) ?>₫</p>
                                <a href="index.php?act=chitiet&id=<?= $relatedProduct['id'] ?>" class="btn btn-sm btn-outline-dark">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sản phẩm liên quan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    if (currentValue < 10) {
        quantityInput.value = currentValue + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

function addToCart() {
    const quantity = document.getElementById('quantity').value;
    const productId = <?= $product['id'] ?? 0 ?>;
    
    // Gửi yêu cầu AJAX để thêm vào giỏ hàng
    fetch('index.php?act=add-to-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId + '&quantity=' + quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Cập nhật số lượng trong header
            const cartBadge = document.querySelector('.badge.rounded-pill.bg-danger');
            if (cartBadge) {
                cartBadge.textContent = data.totalItems;
            }
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi thêm vào giỏ hàng!');
    });
}

function buyNow() {
    const quantity = document.getElementById('quantity').value;
    alert('Mua ngay ' + quantity + ' sản phẩm!');
    // Thêm logic xử lý mua ngay ở đây
}
</script>

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>
