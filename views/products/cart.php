<?php include_once PATH_VIEW . 'layouts/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4"><i class="fas fa-shopping-cart me-2"></i>Giỏ hàng của bạn</h2>
    
    <?php if (empty($cart)): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            Giỏ hàng của bạn đang trống. <a href="index.php" class="alert-link">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Đơn giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Thành tiền</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total = 0;
                                    foreach ($cart as $item): 
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $total += $itemTotal;
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" 
                                                     class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= number_format($item['price']) ?>₫
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="quantity-selector d-inline-flex">
                                                <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity(<?= $item['id'] ?>, -1)">-</button>
                                                <input type="number" class="form-control form-control-sm text-center mx-1" 
                                                       value="<?= $item['quantity'] ?>" min="1" style="width: 60px;"
                                                       onchange="updateQuantity(<?= $item['id'] ?>, 0, this.value)">
                                                <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity(<?= $item['id'] ?>, 1)">+</button>
                                            </div>
                                        </td>
                                        <td class="text-end align-middle">
                                            <strong><?= number_format($itemTotal) ?>₫</strong>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-danger btn-sm" onclick="removeFromCart(<?= $item['id'] ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Tổng tiền</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tạm tính:</span>
                            <strong><?= number_format($total) ?>₫</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Phí vận chuyển:</span>
                            <strong>Miễn phí</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Tổng cộng:</h5>
                            <h5 class="text-danger"><?= number_format($total) ?>₫</h5>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-danger btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Thanh toán
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function updateQuantity(productId, change, newQuantity = null) {
    // Implementation for updating quantity
    alert('Chức năng cập nhật số lượng sẽ được triển khai sau!');
}

function removeFromCart(productId) {
    // Implementation for removing item from cart
    alert('Chức năng xóa sản phẩm sẽ được triển khai sau!');
}
</script>

<?php include_once PATH_VIEW . 'layouts/footer.php'; ?>