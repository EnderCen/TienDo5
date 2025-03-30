// auth.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-auth.js";

// Cấu hình Firebase
const firebaseConfig = {
    apiKey: "AIzaSyC3XjWUU6tyl38Ju2V0sCjgCw72V_qLODc",
    authDomain: "swapface-e45af.firebaseapp.com",
    projectId: "swapface-e45af",
    storageBucket: "swapface-e45af.appspot.com",
    messagingSenderId: "544664035314",
    appId: "1:544664035314:web:31d5b903c4c428c31e156b",
    measurementId: "G-9BCN3S8WJT"
};

// Khởi tạo Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
auth.languageCode = 'vi';
const provider = new GoogleAuthProvider();
provider.setCustomParameters({ prompt: 'select_account' });
// Cập nhật giao diện người dùng
export function updateUserMenu(user) {
    const userNameElement = document.getElementById('user-name');
    const userEmailElement = document.getElementById('user-email');
    const userAvatar = document.getElementById('user-avatar');
    const userPhoneElement = document.getElementById('user-phone'); // Thêm dòng này
    const avatarBtn = document.getElementById('avatar-btn');
    const loginBtn = document.getElementById('google-login-btn');
    const userMenu = document.getElementById('user-menu');

    if (user) {
        userNameElement.textContent = user.displayName || 'Khách';
        userEmailElement.textContent = user.email || '';
        userAvatar.src = user.photoURL || 'https://via.placeholder.com/40';
        userPhoneElement.textContent = user.phoneNumber || 'Không có số điện thoại'; // Hiển thị số điện thoại nếu có

        loginBtn.style.display = 'none';
        avatarBtn.style.display = 'block';

        localStorage.setItem('user', JSON.stringify({
            uid: user.uid,
            displayName: user.displayName,
            email: user.email,
            photoURL: user.photoURL,
            phoneNumber: user.phoneNumber // Lưu số điện thoại vào localStorage
        }));
    } else {
        loginBtn.style.display = 'block';
        avatarBtn.style.display = 'none';
        userMenu.style.display = 'none';
        localStorage.removeItem('user');
    }
}


// Xử lý sự kiện đăng nhập
document.getElementById('google-login-btn')?.addEventListener('click', async () => {
    try {
        const result = await signInWithPopup(auth, provider);
        updateUserMenu(result.user);
    } catch (error) {
        console.error("Lỗi đăng nhập:", error);
        alert(`Lỗi: ${error.message}`);
    }
});

// Xử lý sự kiện đăng xuất
document.getElementById('logout-btn')?.addEventListener('click', async (e) => {
    e.preventDefault();
    
    try {
        // 1. Cập nhật giao diện ngay
        updateUserMenu(null);
        
        // 2. Xóa dữ liệu local
        localStorage.removeItem('user');
        sessionStorage.removeItem('user');
        
        // 3. Đăng xuất Firebase
        await signOut(auth);
        
        // 4. Đồng bộ giữa các tab
        localStorage.setItem('logout-event', Date.now().toString());
        localStorage.removeItem('logout-event');
        
        // 5. Chuyển hướng
        window.location.href = '/';
        
    } catch (error) {
        console.error("Lỗi đăng xuất:", error);
        window.location.href = '/'; // Vẫn chuyển hướng dù lỗi
    }
});



// Toggle menu dropdown
document.getElementById('avatar-btn')?.addEventListener('click', (e) => {
    e.stopPropagation();
    const menu = document.getElementById('user-menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});

// Đóng menu khi click bên ngoài
document.addEventListener('click', () => {
    document.getElementById('user-menu').style.display = 'none';
});

// Theo dõi trạng thái đăng nhập
onAuthStateChanged(auth, (user) => {
    updateUserMenu(user);
});

// Kiểm tra trạng thái khi tải trang
document.addEventListener('DOMContentLoaded', () => {
    const userData = localStorage.getItem('user');
    if (userData) {
        updateUserMenu(JSON.parse(userData));
    }
});

// Theo dõi trạng thái đăng nhập và đồng bộ giữa các tab
onAuthStateChanged(auth, (user) => {
    if (user) {
        // Lưu thông tin user vào storage
        localStorage.setItem('user', JSON.stringify({
            uid: user.uid,
            displayName: user.displayName,
            email: user.email,
            photoURL: user.photoURL,
            phoneNumber: user.phoneNumber
        }));
    } else {
        // Xóa thông tin user khi đăng xuất
        localStorage.removeItem('user');
        sessionStorage.removeItem('user');
    }
    updateUserMenu(user);
});

// Lắng nghe sự kiện storage để đồng bộ giữa các tab
window.addEventListener('storage', (event) => {
    if (event.key === 'user') {
        if (event.newValue) {
            const user = JSON.parse(event.newValue);
            updateUserMenu(user);
        } else {
            updateUserMenu(null);
        }
    }
});

window.addEventListener('popstate', () => {
    updateUserMenu(null);
});