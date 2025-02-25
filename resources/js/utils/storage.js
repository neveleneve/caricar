import { STORAGE_KEYS } from "./constants";
import CryptoJS from "crypto-js";

const SECRET_KEY = import.meta.env.VITE_APP_SECRET_KEY;

export const storage = {
    encrypt(data) {
        return CryptoJS.AES.encrypt(
            JSON.stringify(data),
            SECRET_KEY
        ).toString();
    },
    decrypt(text) {
        const bytes = CryptoJS.AES.decrypt(text, SECRET_KEY);
        return JSON.parse(bytes.toString(CryptoJS.enc.Utf8));
    },
    setItem(key, value) {
        localStorage.setItem(key, this.encrypt(value));
    },
    getItem(key) {
        const item = localStorage.getItem(key);
        return item ? this.decrypt(item) : null;
    },
    removeItem(key) {
        localStorage.removeItem(key);
    },
    clear() {
        Object.values(STORAGE_KEYS).forEach(this.removeItem);
    },
};
