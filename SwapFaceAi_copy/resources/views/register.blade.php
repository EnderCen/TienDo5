<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/register.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">                                                                                                                                                                                                                                                                                                                                                                         
                <div class="card shadow-sm my-5">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-4">Đăng Ký</h1>                                                                                                                                                                                                                                                                                                                                                                                               
                        <form id="registerForm" action="{{ url('/register') }}" method="post" enctype="multipart/form-data">
                            @csrf                                                                               
                            <!-- Ảnh đại diện -->
                            <div class="mb-4 text-center">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type="file" id="avatarUpload" name="avatar" accept=".png, .jpg, .jpeg">
                                        <label for="avatarUpload"><i class="fas fa-camera"></i></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="avatarPreview" style="background-image: url('https://via.placeholder.com/150');">
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted">Ấn vào ảnh để thay đổi</small>
                            </div>
                            
                            <!-- Tài khoản -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Tài khoản</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <!-- Mật khẩu -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="form-text">Mật khẩu tối thiểu 6 ký tự</div>
                            </div>
                            
                            <!-- Nhập lại mật khẩu -->
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                <div id="passwordError" class="invalid-feedback">Mật khẩu không khớp</div>
                            </div>
                            
                            <!-- Tên hiển thị -->
                            <div class="mb-3">
                                <label for="displayName" class="form-label">Tên hiển thị</label>
                                <input type="text" class="form-control" id="displayName" name="displayName" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <!-- Số điện thoại -->
                            <div class="mb-4">
                                <label for="phoneNumber" class="form-label">Số điện thoại (tùy chọn)</label>
                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber">
                            </div>
                            
                            <!-- Options -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Ghi nhớ tôi</label>
                                </div>
                                <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                            </div>
                            
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i> Đăng Ký
                            </button>
                        </form>
                        
                        <div class="text-center">
                            <span class="text-muted">Đã có tài khoản?</span>
                            <a href="http://localhost:8000/register" class="text-decoration-none ms-1">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        <script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Ngăn trang tải lại

    let formData = new FormData(this); // Thu thập dữ liệu form

    fetch("{{ url('/register') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            alert("Có lỗi xảy ra: " + JSON.stringify(data.errors));
        } else {
            alert("Đăng ký thành công!");
            window.location.href = "http://localhost:8000/login";
        }
    })
    .catch(error => console.error("Lỗi:", error));
});
</script>

        // Password validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const passwordError = document.getElementById('passwordError');
            
            if (password !== confirmPassword) {
                e.preventDefault();
                document.getElementById('confirmPassword').classList.add('is-invalid');
                passwordError.style.display = 'block';
            } else {
                document.getElementById('confirmPassword').classList.remove('is-invalid');
                passwordError.style.display = 'none';
            }
        });

        // Real-time password matching check
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const passwordError = document.getElementById('passwordError');
            
            if (password !== confirmPassword && confirmPassword.length > 0) {
                this.classList.add('is-invalid');
                passwordError.style.display = 'block';
            } else {
                this.classList.remove('is-invalid');
                passwordError.style.display = 'none';
            }
        });

        // Avatar upload preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').style.backgroundImage = 'url(' + e.target.result + ')';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        document.getElementById('avatarUpload').addEventListener('change', function() {
            readURL(this);
        });
    </script>
</body>
</html>