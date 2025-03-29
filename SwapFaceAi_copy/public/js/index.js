// Import Firebase SDK
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-auth.js";

// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyC3XjWUU6tyl38Ju2V0sCjgCw72V_qLODc",
  authDomain: "swapface-e45af.firebaseapp.com",
  projectId: "swapface-e45af",
  storageBucket: "swapface-e45af.appspot.com",
  messagingSenderId: "544664035314",
  appId: "1:544664035314:web:31d5b903c4c428c31e156b",
  measurementId: "G-9BCN3S8WJT"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
auth.languageCode = 'vi';
const provider = new GoogleAuthProvider();

// UI Event Handlers
document.getElementById("showGridBtn1")?.addEventListener("click", function() {
    document.getElementById("imageGrid1").classList.remove("hidden");
    document.getElementById("imageGrid2").classList.add("hidden");
});

document.getElementById("showGridBtn2")?.addEventListener("click", function() {
    document.getElementById("imageGrid2").classList.remove("hidden");
    document.getElementById("imageGrid1").classList.add("hidden");
});

// Image selection handlers
document.querySelectorAll("#imageGrid1 img, #imageGrid2 img").forEach(img => {
    img.addEventListener("click", function() {
        const fileInput = document.getElementById("2");
        const selectedImage = document.getElementById("selectedImage");
        selectedImage.src = this.src;
        selectedImage.classList.remove("hidden");
        fileInput.value = "";
        
        // Remove opacity from all images
        document.querySelectorAll("#imageGrid1 img, #imageGrid2 img").forEach(image => {
            image.classList.remove("opacity-50");
        });
        
        // Add opacity to selected image
        this.classList.add("opacity-50");
    });
});

// File input handlers
document.getElementById("2")?.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("selectedImage").src = e.target.result;
            document.getElementById("selectedImage").classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    }
});

// Publish button handler
document.querySelector(".publish-button")?.addEventListener("click", async function() {
    const sourceFile = document.getElementById("1").files[0];
    const targetImg = document.getElementById("selectedImage").src;
    const text = document.querySelector("textarea").value.trim();
    const voice = document.querySelector("select[name='voice']").value;

    if (!sourceFile || !targetImg) {
        alert("Vui lòng chọn cả hai hình ảnh!");
        return;
    }
    if (!text) {
        alert("Vui lòng nhập nội dung!");
        return;
    }

    try {
        // Convert target image to file
        const responseTarget = await fetch(targetImg);
        const targetBlob = await responseTarget.blob();
        const targetFile = new File([targetBlob], "target.jpg", { type: "image/jpeg" });

        // Face Swap
        const formDataFaceSwap = new FormData();
        formDataFaceSwap.append("source", sourceFile);
        formDataFaceSwap.append("target", targetFile);

        let response = await fetch("http://127.0.0.1:8000/face_swap/", { 
            method: "POST", 
            body: formDataFaceSwap 
        });        
        let data = await response.json();
        if (!response.ok) throw new Error("Lỗi Face Swap!");
        alert("Hoàn thành Face Swap!");

        // Text to Speech
        const formDataTTS = new FormData();
        formDataTTS.append("text", text);
        formDataTTS.append("voice", voice);

        response = await fetch("/text_to_speech/", { method: "POST", body: formDataTTS });
        data = await response.json();
        if (!response.ok) throw new Error("Lỗi Text-to-Speech!");
        alert("Hoàn thành Text-to-Speech!");

        // Animate Image
        response = await fetch("/animate_image/", { method: "POST" });
        data = await response.json();
        if (!response.ok) throw new Error("Lỗi Animate Image!");

        alert("Hoàn thành Animate Image!");
        window.location.href = data.output_video;
    } catch (error) {
        console.error("Lỗi:", error);
        alert("Đã xảy ra lỗi trong quá trình xử lý!");
    }
});

// Auth state management
function updateUserMenu(user) {
    const userNameElement = document.getElementById('user-name');
    const userEmailElement = document.getElementById('user-email');
    const userAvatar = document.getElementById('user-avatar');
    const avatarBtn = document.getElementById('avatar-btn');
    const loginBtn = document.getElementById('google-login-btn');
    const userMenu = document.getElementById('user-menu');
    
    if (userNameElement) userNameElement.textContent = user.displayName || 'Khách';
    if (userEmailElement) userEmailElement.textContent = user.email || '';
    if (userAvatar) userAvatar.src = user.photoURL || 'https://via.placeholder.com/40';
    
    if (loginBtn) loginBtn.style.display = 'none';
    if (avatarBtn) avatarBtn.style.display = 'block';
    if (userMenu) userMenu.style.display = 'none';
}

// Initialize auth state
onAuthStateChanged(auth, (user) => {
    if (user) {
        // Save user data to localStorage
        localStorage.setItem('user', JSON.stringify({
            uid: user.uid,
            displayName: user.displayName,
            email: user.email,
            photoURL: user.photoURL
        }));
        updateUserMenu(user);
    } else {
        // Remove user data if not logged in
        localStorage.removeItem('user');
    }
});

// Check for existing auth on page load
document.addEventListener('DOMContentLoaded', function() {
    const userData = localStorage.getItem('user');
    if (userData) {
        const user = JSON.parse(userData);
        console.log("User found in localStorage:", user);
        updateUserMenu(user);
    }
    
    // Add logout handler if exists
    document.getElementById("logout-btn")?.addEventListener("click", () => {
        auth.signOut().then(() => {
            localStorage.removeItem('user');
            window.location.reload();
        }).catch((error) => {
            console.error("Logout error:", error);
        });
    });
});