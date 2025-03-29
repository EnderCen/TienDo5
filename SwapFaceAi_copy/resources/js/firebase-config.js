import { initializeApp } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-app.js";
import { getAuth, GoogleAuthProvider } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyC3XjWUU6tyl38Ju2V0sCjgCw72V_qLODc",
    authDomain: "swapface-e45af.firebaseapp.com",
    projectId: "swapface-e45af",
    storageBucket: "swapface-e45af.appspot.com",
    messagingSenderId: "544664035314",
    appId: "1:544664035314:web:31d5b903c4c428c31e156b",
    measurementId: "G-9BCN3S8WJT"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
auth.languageCode = 'vi';
const provider = new GoogleAuthProvider();

export { auth, provider };