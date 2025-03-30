<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Đăng nhập</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">

            @csrf
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ghi nhớ tôi</label>
                </div>
                <a href="#" class="forgot-password">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="login-btn">Đăng nhập</button>
        </form>

        <button type="button" class="google-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google logo" class="google-icon">
            Đăng nhập với Google
        </button>

        <div class="register-link">
            Chưa có tài khoản? <a href="http://localhost:8000/register">Đăng ký</a>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorMessage = "{{ session('error') }}";
        if (errorMessage) {
            alert(errorMessage);
        }
    });
</script>
</html>
