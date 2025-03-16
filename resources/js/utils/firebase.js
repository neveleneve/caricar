import { initializeApp } from "firebase/app";
import {
    getAuth,
    FacebookAuthProvider,
    GoogleAuthProvider,
    signInWithPopup,
    signOut,
    setPersistence,
    browserSessionPersistence,
} from "firebase/auth";

const firebaseConfig = {
    apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
    authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
    projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
    storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
    messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
    appId: import.meta.env.VITE_FIREBASE_APP_ID,
    measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID,
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

const signInWithGoogle = async () => {
    try {
        await setPersistence(auth, browserSessionPersistence);
        const provider = new GoogleAuthProvider();
        const result = await signInWithPopup(auth, provider);
        return {
            user: result.user,
            token: GoogleAuthProvider.credentialFromResult(result)?.accessToken,
        };
    } catch (error) {
        if (error.code === "auth/popup-blocked") {
            throw new Error("Please allow popups for this website");
        }
        if (error.code === "auth/popup-closed-by-user") {
            throw new Error("Login cancelled by user");
        }
        throw error;
    }
};
const signInWithFacebook = async () => {
    try {
        await setPersistence(auth, browserSessionPersistence);
        const facebookProvider = new FacebookAuthProvider();

        facebookProvider.addScope("email");
        facebookProvider.addScope("public_profile");

        const result = await signInWithPopup(auth, facebookProvider);
        const credential = FacebookAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;

        return {
            user: result.user,
            token: token,
        };
    } catch (error) {
        if (error.code === "auth/popup-blocked") {
            throw new Error("Please allow popups for this website");
        }
        if (error.code === "auth/popup-closed-by-user") {
            throw new Error("Login cancelled by user");
        }
        throw error;
    }
};

const signOutUser = async () => {
    try {
        await signOut(auth);
    } catch (error) {
        console.error(error);
    }
};

export { auth, signInWithFacebook, signInWithGoogle, signOutUser };
