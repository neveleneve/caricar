import { initializeApp } from "firebase/app";
import {
    getAuth,
    GoogleAuthProvider,
    signInWithPopup,
    signOut,
} from "firebase/auth";

const firebaseConfig = {
    apiKey: "AIzaSyBTeZUQwwwpuLWkHRhHOia7Mt0kFrM0Fk0",
    authDomain: "caricar-2271c.firebaseapp.com",
    projectId: "caricar-2271c",
    storageBucket: "caricar-2271c.firebasestorage.app",
    messagingSenderId: "88528548623",
    appId: "1:88528548623:web:29828db12ee6935fd4447a",
    measurementId: "G-5NHD5LYZ8R",
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

const signInWithGoogle = async () => {
    try {
        const result = await signInWithPopup(auth, provider);
        return result.user;
    } catch (error) {
        console.error(error);
        return null;
    }
};

const signOutUser = async () => {
    try {
        await signOut(auth);
    } catch (error) {
        console.error(error);
    }
};

export { auth, signInWithGoogle, signOutUser };
