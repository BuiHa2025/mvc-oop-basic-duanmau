</main>

<!-- Footer -->
<footer class="bg-dark text-light mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-wine-glass-alt me-2"></i>Cửa hàng rượu</h5>
                <p class="text-muted">Chuyên cung cấp các loại rượu vang, rượu mạnh và đồ uống cao cấp.</p>
            </div>
            <div class="col-md-4">
                <h6>Liên kết nhanh</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-light text-decoration-none"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                    <li><a href="index.php?act=categories" class="text-light text-decoration-none"><i class="fas fa-tags me-1"></i>Danh mục</a></li>
                    <li><a href="index.php?act=products" class="text-light text-decoration-none"><i class="fas fa-wine-bottle me-1"></i>Sản phẩm</a></li>
                    <li><a href="index.php?act=contact" class="text-light text-decoration-none"><i class="fas fa-phone me-1"></i>Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Thông tin liên hệ</h6>
                <p class="text-muted mb-1"><i class="fas fa-map-marker-alt me-2"></i>123 Đường ABC, Quận XYZ, HN</p>
                <p class="text-muted mb-1"><i class="fas fa-phone me-2"></i>(028) 1234 5678</p>
                <p class="text-muted mb-1"><i class="fas fa-envelope me-2"></i>info@cuahangруou.com</p>
            </div>
        </div>
        <hr class="my-3">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted mb-0">&copy; <?= date('Y') ?> Cửa hàng rượu. Tất cả quyền được bảo lưu.</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="text-muted mb-0">Phát triển bởi <strong>MVC-OOP System</strong></p>
            </div>
        </div>
    </div>
</footer>

<!-- Back to top button -->
<button type="button" class="btn btn-primary btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>

<style>
#btn-back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
    z-index: 1000;
    border-radius: 50%;
    width: 50px;
    height: 50px;
}

footer a:hover {
    color: #ffc107 !important;
}
</style>

<script>
// Back to top button functionality
let mybutton = document.getElementById("btn-back-to-top");

window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

mybutton.addEventListener("click", function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});
</script>

</body>
</html>
