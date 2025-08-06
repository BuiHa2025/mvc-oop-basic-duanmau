</main>

<!-- Footer -->
<footer class="bg-dark text-light mt-5">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Thông tin cửa hàng -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h5 class="text-warning mb-3">
                        <i class="fas fa-wine-glass-alt me-2"></i>Wine Store Premium
                    </h5>
                    <p class="text-light mb-3">
                        Chuyên cung cấp các loại rượu vang, rượu mạnh và đồ uống cao cấp từ khắp nơi trên thế giới.
                        Cam kết chất lượng và dịch vụ tốt nhất.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-zalo"></i></a>
                    </div>
                </div>
            </div>

            <!-- Danh mục sản phẩm -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-section">
                    <h6 class="text-warning mb-3">Danh mục</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="index.php?act=category&category_id=1" class="text-light text-decoration-none">
                            <i class="fas fa-wine-glass me-2"></i>Rượu Vang
                        </a></li>
                        <li><a href="index.php?act=category&category_id=2" class="text-light text-decoration-none">
                            <i class="fas fa-glass-whiskey me-2"></i>Rượu Mạnh
                        </a></li>
                        <li><a href="index.php?act=category&category_id=3" class="text-light text-decoration-none">
                            <i class="fas fa-champagne-glasses me-2"></i>Rượu Sâm Panh
                        </a></li>
                        <li><a href="index.php?act=category&category_id=4" class="text-light text-decoration-none">
                            <i class="fas fa-seedling me-2"></i>Rượu Truyền Thống
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Liên kết nhanh -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-section">
                    <h6 class="text-warning mb-3">Liên kết</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="index.php" class="text-light text-decoration-none">
                            <i class="fas fa-home me-2"></i>Trang chủ
                        </a></li>
                        <li><a href="index.php?act=search" class="text-light text-decoration-none">
                            <i class="fas fa-search me-2"></i>Tìm kiếm
                        </a></li>
                        <li><a href="index.php?act=news" class="text-light text-decoration-none">
                            <i class="fas fa-newspaper me-2"></i>Tin tức
                        </a></li>
                        <li><a href="index.php?act=contact" class="text-light text-decoration-none">
                            <i class="fas fa-phone me-2"></i>Liên hệ
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h6 class="text-warning mb-3">Thông tin liên hệ</h6>
                    <div class="contact-info">
                        <div class="contact-item mb-2">
                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                            <span class="text-light">Số 2 Trịnh Văn Bô , P.Bắc Từ Liêm, Hà Nội</span>
                        </div>
                        <div class="contact-item mb-2">
                            <i class="fas fa-phone text-warning me-2"></i>
                            <span class="text-light">Hotline: (028) 3822 1234</span>
                        </div>
                        <div class="contact-item mb-2">
                            <i class="fas fa-envelope text-warning me-2"></i>
                            <span class="text-light">info@winestore.vn</span>
                        </div>
                        <div class="contact-item mb-2">
                            <i class="fas fa-clock text-warning me-2"></i>
                            <span class="text-light">T2-CN: 8:00 - 22:00</span>
                        </div>
                    </div>
                    
                    <!-- Newsletter -->
                    <div class="newsletter mt-3">
                        <h6 class="text-warning mb-2">Đăng ký nhận tin</h6>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email của bạn...">
                            <button class="btn btn-warning" type="button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chính sách và bản quyền -->
        <hr class="my-4 border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-muted mb-0">
                    &copy; <?= date('Y') ?> Wine Store Premium. Tất cả quyền được bảo lưu.
                </p>
            </div>
            <div class="col-md-6">
                <div class="footer-policies text-md-end">
                    <a href="#" class="text-muted text-decoration-none me-3">Chính sách bảo mật</a>
                    <a href="#" class="text-muted text-decoration-none me-3">Điều khoản sử dụng</a>
                    <a href="#" class="text-muted text-decoration-none">Chính sách đổi trả</a>
                </div>
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
