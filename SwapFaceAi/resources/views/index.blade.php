<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AIClip - Tạo Hình Ảnh AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    <header>
        <nav class="navbar a">
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
                <!-- Nút đăng nhập (hiển thị khi chưa đăng nhập) -->
                <button id="google-login-btn" class="btn login">Đăng nhập</button>
                
                <!-- Avatar (hiển thị khi đã đăng nhập) -->
                <button id="avatar-btn" style="display: none;">
                    <img id="user-avatar" src="" alt="User Avatar">
                </button>
                
                <!-- Menu dropdown -->
                <div class="user-menu" id="user-menu" style="display: none;">
                    <div class="user-header">
                        <div id="user-name" class="user-name">Khách</div>
                        <div id="user-email" class="user-email"></div>
                    </div>
                    <div class="dropdown-content">
                        <a href="http://localhost:8000/index" id="create-video-btn">Tạo video</a>
                        <a href="/">Video của tôi</a>
                        <a href="/">Lịch sử</a>
                        <a href="/" id="logout-btn">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex flex-grow p-6">
        <aside class="w-1/3 bg-white p-4 shadow-md rounded-lg relative">
            <div class="border rounded-lg p-4 mb-4 flex flex-col space-y-4">
                <label class="block font-semibold">Chọn một MC</label>
            </div>
            <div class="flex justify-between my-8 px-20">
                <button id="showGridBtn1" class="bg-purple-600 text-white w-14 h-14 rounded-full flex items-center justify-center">
                    <img src="image/male.png" alt="Button Image 1" class="w-full h-full object-cover">
                </button>
                <button id="showGridBtn2" class="bg-purple-600 text-white w-14 h-14 rounded-full flex items-center justify-center">
                    <img src="image/female.png" alt="Button Image 2" class="w-full h-full object-cover">
                </button>
            </div>
            <div id="imageGrid1" class="grid grid-cols-2 gap-4 mt-4 w-full flex-grow overflow-auto">
                <img src="image/MC.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC.jpg" alt="Sample Image" class="grid-image">
            </div>
            <div id="imageGrid2" class="grid grid-cols-2 gap-4 mt-4 w-full flex-grow overflow-auto hidden">
                <img src="image/MC1.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC1.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC1.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC1.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC1.jpg" alt="Sample Image" class="grid-image">
                <img src="image/MC1.jpg" alt="Sample Image" class="grid-image">
            </div>
        </aside>

        <section class="w-3/4 px-6">
            <div class="border rounded-lg p-4 mb-4 flex flex-col space-y-4">
                <label class="block font-semibold">Chọn khuôn mặt</label>
                <input id="1" type="file" class="w-full p-2 border rounded-lg">
            </div>
            <div class="border rounded-lg p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Nhập nội dung</h3>
                <textarea class="w-full p-2 border rounded-lg" rows="4" placeholder="Nhập nội dung tại đây..."></textarea>
            </div>
            <div class="border rounded-lg p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Chọn giọng nói</h3>
                <select class="form-select w-full p-2 border rounded-lg" name="voice" required>
                    <option value="1">speechify_8</option>
                    <option value="2">cdteam</option>
                    <option value="3">diep-chi</option>
                    <option value="4">speechify_2</option>
                    <option value="5">speechify_5</option>
                    <option value="6">nguyen-ngoc-ngan</option>
                    <option value="7">speechify_7</option>
                    <option value="8">speechify_4</option>
                    <option value="9">speechify_1</option>
                    <option value="10">quynh</option>
                    <option value="11">cross_lingual_prompt</option>
                    <option value="12">speechify_6</option>
                    <option value="13">zero_shot_prompt</option>
                    <option value="14">speechify_3</option>
                    <option value="15">son-tung-mtp</option>
                    <option value="16">nu-nhe-nhang</option>
                    <option value="17">speechify_9</option>
                    <option value="18">speechify_11</option>
                    <option value="19">speechify_10</option>
                    <option value="20">speechify_12</option>
                    <option value="21">doremon</option>
                    <option value="22">jack-sparrow</option>
                    <option value="23">nsnd-le-chuc</option>
                </select>                
            </div>
        </section>
        <div class="border rounded-lg p-4 mb-1 w-1/3 h-auto">
            <h3 class="text-lg font-semibold mb-2">Hình ảnh đã chọn</h3>
            <div id="selectedImageContainer" class="w-full flex justify-center">
                <img id="selectedImage" src="" alt="Ảnh đã chọn" class="hidden w-96 h-auto rounded-lg shadow-lg">
            </div>
            <label class="block font-semibold">Chọn ảnh cần SwapFace</label>
            <input id="2" type="file" class="w-full p-2 border rounded-lg">
            <button class="publish-button">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828640.png" alt="Xuất bản">
                Xuất bản
            </button>
        </div>
    </main>

    <footer class="bg-gray-900 text-white text-center py-6 mt-auto">
        <p>&copy; 2025 SwapFace. Mọi quyền được bảo lưu.</p>
    </footer>
    <script type="module" src="{{ asset('js/firebase-config.js') }}"></script>
    <script type="module" src="{{ asset('js/index.js') }}"></script>
    <script type="module" src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
