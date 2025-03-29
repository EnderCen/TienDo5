<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIClip - Nền tảng chỉnh sửa video bằng AI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="https://aiclip.ai/wp-content/uploads/2023/10/logo.svg" alt="Logo AIClip">
            </div>
            <ul class="nav-links">
                <li><a href="#">Tính năng</a></li>
                <li><a href="#">Cách hoạt động</a></li>
                <li><a href="#">Giá cả</a></li>
                <li><a href="#">Tài nguyên</a></li>
            </ul>
            <div class="auth-buttons">
                <button id="google-login-btn" class="btn login">Đăng nhập</button>
                <button id="avatar-btn" style="display: none;">
                    <img id="user-avatar" src="" alt="User Avatar">
                </button>
                <div class="user-menu" id="user-menu" style="display: none;">
                    <div class="user-header">
                        <div id="user-name" class="user-name">Khách</div>
                        <div id="user-email" class="user-email"></div>
                    </div>
                    <div class="dropdown-content">
                        <a href="#" id="create-video-btn">Tạo video</a>
                        <a href="/">Video của tôi</a>
                        <a href="#">Lịch sử</a>
                        <a href="#" id="logout-btn">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Chỉnh sửa video bằng AI cho mọi người</h1>
            <p>Biến đổi video của bạn với AI trong vài giây. Không cần kinh nghiệm.</p>
            <div class="cta-buttons">
                <button class="btn primary">Dùng thử miễn phí</button>
                <button class="btn secondary">Xem hướng dẫn</button>
            </div>
            <div class="hero-image">
                <img src="https://aiclip.ai/wp-content/uploads/2023/10/hero-image.jpg" alt="Giao diện AIClip">
            </div>
        </section>

        <section class="features">
            <div class="section-title">
                <h2>Tính năng mạnh mẽ nâng tầm video của bạn</h2>
                <p>Khám phá cách AIClip giúp bạn tạo video chất lượng chuyên nghiệp một cách dễ dàng</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3>Nâng cấp video bằng AI</h3>
                    <p>Tự động cải thiện chất lượng video, ổn định cảnh quay rung và tăng cường màu sắc.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h3>Chỉnh sửa thông minh</h3>
                    <p>Công cụ AI giúp cắt, chỉnh sửa và sắp xếp clip để đạt hiệu quả tối đa.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-closed-captioning"></i>
                    </div>
                    <h3>Phụ đề tự động</h3>
                    <p>Tạo phụ đề chính xác tự động bằng nhiều ngôn ngữ.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h3>Âm nhạc & Âm thanh</h3>
                    <p>Truy cập nhạc miễn phí bản quyền và hiệu ứng âm thanh để hoàn thiện video.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-film"></i>
                    </div>
                    <h3>Mẫu template</h3>
                    <p>Lựa chọn từ các mẫu thiết kế chuyên nghiệp cho mọi dịp.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h3>Chia sẻ dễ dàng</h3>
                    <p>Xuất và chia sẻ trực tiếp lên các nền tảng mạng xã hội với cài đặt tối ưu.</p>
                </div>
            </div>
        </section>

        <section class="how-it-works">
            <div class="section-title">
                <h2>AIClip hoạt động như thế nào</h2>
                <p>Tạo video ấn tượng chỉ với vài bước đơn giản</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Tải video lên</h3>
                    <p>Kéo thả file video hoặc nhập từ lưu trữ đám mây.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Để AI làm việc</h3>
                    <p>AI của chúng tôi phân tích nội dung và đề xuất cải thiện.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Tùy chỉnh chỉnh sửa</h3>
                    <p>Điều chỉnh kết quả với các công cụ chỉnh sửa dễ sử dụng.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Xuất & chia sẻ</h3>
                    <p>Tải video về hoặc chia sẻ trực tiếp lên mạng xã hội.</p>
                </div>
            </div>
        </section>

        <section class="pricing">
            <div class="section-title">
                <h2>Giá cả minh bạch, đơn giản</h2>
                <p>Chọn gói phù hợp với nhu cầu của bạn</p>
            </div>
            <div class="pricing-cards">
                <div class="pricing-card">
                    <h3>Cơ bản</h3>
                    <div class="price">0đ<span>/tháng</span></div>
                    <ul class="pricing-features">
                        <li>Xuất 5 video mỗi tháng</li>
                        <li>Công cụ chỉnh sửa cơ bản</li>
                        <li>Độ phân giải 720p</li>
                        <li>Watermark trên video xuất</li>
                    </ul>
                    <button class="btn">Bắt đầu</button>
                </div>
                <div class="pricing-card popular">
                    <div class="popular-badge">Phổ biến</div>
                    <h3>Chuyên nghiệp</h3>
                    <div class="price">450.000đ<span>/tháng</span></div>
                    <ul class="pricing-features">
                        <li>Xuất video không giới hạn</li>
                        <li>Tất cả công cụ chỉnh sửa AI</li>
                        <li>Độ phân giải 1080p</li>
                        <li>Không watermark</li>
                        <li>Hỗ trợ ưu tiên</li>
                    </ul>
                    <button class="btn primary">Dùng thử miễn phí</button>
                </div>
                <div class="pricing-card">
                    <h3>Nhóm</h3>
                    <div class="price">1.150.000đ<span>/tháng</span></div>
                    <ul class="pricing-features">
                        <li>Tất cả tính năng gói Pro</li>
                        <li>3 thành viên nhóm</li>
                        <li>Độ phân giải 4K</li>
                        <li>Làm việc nhóm</li>
                        <li>Phân tích nâng cao</li>
                    </ul>
                    <button class="btn">Liên hệ bán hàng</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="https://aiclip.ai/wp-content/uploads/2023/10/logo-white.svg" alt="Logo AIClip">
                </div>
                <p>Nền tảng chỉnh sửa video bằng AI giúp bạn tạo video chất lượng chuyên nghiệp trong vài phút.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Sản phẩm</h4>
                <ul>
                    <li><a href="#">Tính năng</a></li>
                    <li><a href="#">Giá cả</a></li>
                    <li><a href="#">Cách hoạt động</a></li>
                    <li><a href="#">Tích hợp</a></li>
                    <li><a href="#">Cập nhật</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Tài nguyên</h4>
                <ul>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Hướng dẫn</a></li>
                    <li><a href="#">Trung tâm trợ giúp</a></li>
                    <li><a href="#">Mẫu template</a></li>
                    <li><a href="#">Cộng đồng</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Công ty</h4>
                <ul>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                    <li><a href="#">Liên hệ</a></li>
                    <li><a href="#">Báo chí</a></li>
                    <li><a href="#">Pháp lý</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 AIClip. Bảo lưu mọi quyền.</p>
        </div>
    </footer>
    <script type="module" src="js/firebase-config.js"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
</body>
</html>