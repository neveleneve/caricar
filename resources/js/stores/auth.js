import { defineStore } from "pinia";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: storage.getItem(STORAGE_KEYS.TOKEN) || null,
        user: storage.getItem(STORAGE_KEYS.AUTH) || null,
        loading: false,
        error: null,
    }),

    actions: {
        async login(credentials) {
            try {
                this.loading = true;
                this.error = null;

                const response = await axios.post("/api/login", credentials);
                const { token, user } = response.data;

                this.setAuth(token);
                this.user = user;
                storage.setItem(STORAGE_KEYS.AUTH, user);

                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;

                return response;
            } catch (error) {
                this.error = error.response?.data?.message || "Login failed";
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async loginWithGoogle(googleData) {
            try {
                this.loading = true;
                this.error = null;

                const response = await axios.post(
                    "/api/login/google",
                    googleData
                );
                const { token, user } = response.data;

                this.setAuth(token);
                this.user = user;
                storage.setItem(STORAGE_KEYS.AUTH, user);

                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;

                return response;
            } catch (error) {
                this.error =
                    error.response?.data?.message || "Google login failed";
                const errors =
                    error.response?.data?.error ||
                    "Google login failed fasddfa";
                console.log(errors);

                throw error;
            } finally {
                this.loading = false;
            }
        },

        async loginWithFacebook(facebookData) {
            try {
                this.loading = true;
                this.error = null;

                const response = await axios.post(
                    "/api/login/facebook",
                    facebookData
                );
                const { token, user } = response.data;

                this.setAuth(token);
                this.user = user;
                storage.setItem(STORAGE_KEYS.AUTH, user);

                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;

                return response;
            } catch (error) {
                this.error =
                    error.response?.data?.message || "Facebook login failed";
                throw error;
            } finally {
                this.loading = false;
            }
        },

        setAuth(token) {
            this.token = token;
            storage.setItem(STORAGE_KEYS.TOKEN, token);
        },

        clearAuth() {
            this.token = null;
            this.user = null;
            this.error = null;
            storage.clear();
            delete axios.defaults.headers.common["Authorization"];
        },

        logout() {
            this.clearAuth();
        },

        async verifyToken() {
            try {
                if (!this.token) return false;
                const response = await axios.get("/api/auth/verify");
                return response.status === 200;
            } catch (error) {
                this.clearAuth();
                return false;
            }
        },
    },

    getters: {
        isAuthenticated: (state) => !!state.token,
    },
});
