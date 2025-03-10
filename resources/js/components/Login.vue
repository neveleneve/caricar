<template>
    <div
        class="flex min-h-screen transition-colors duration-200 bg-gradient-to-br from-blue-50 to-gray-100 dark:from-gray-900 dark:to-gray-800"
    >
        <button
            @click="toggleTheme"
            :disabled="themeStore.isTransitioning"
            class="absolute p-2 rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-700 top-4 right-4 dark:text-pastel-light-500 hover:bg-pastel-light-700 dark:hover:bg-pastel-dark-600"
            :class="{ 'opacity-50 cursor-wait': themeStore.isTransitioning }"
        >
            <span
                class="material-icons theme-icon"
                :class="[
                    themeStore.isDark ? 'dark-to-light' : 'light-to-dark',
                    { 'animate-theme': themeStore.isTransitioning },
                ]"
            >
                {{ themeStore.isDark ? "light_mode" : "dark_mode" }}
            </span>
        </button>
        <div
            class="hidden w-1/2 transition-colors duration-200 bg-pastel-blue-600 dark:bg-pastel-blue-800 lg:flex lg:flex-col lg:justify-center lg:items-center"
        >
            <div class="px-12 text-center">
                <div class="flex flex-col items-center">
                    <img
                        :src="'/assets/logo/caricar-dark.png'"
                        class="h-20 mb-1"
                        alt="Logo Politeam Dark"
                    />
                </div>
                <p class="text-xl text-blue-100">
                    Your reliable payment system, simplified.
                </p>
            </div>
        </div>

        <div
            class="flex items-center justify-center w-full p-6 lg:w-1/2 bg-pastel-light-500 dark:bg-pastel-dark-700"
        >
            <div class="w-full max-w-md space-y-8">
                <div class="flex flex-col items-center mb-10 lg:hidden">
                    <img
                        v-if="themeStore.isDark"
                        :src="'/assets/logo/caricar-dark.png'"
                        class="h-9"
                        alt="Logo Caricar.id Dark"
                    />
                    <img
                        v-else
                        :src="'/assets/logo/caricar-light.png'"
                        class="h-9"
                        alt="Logo Caricar.id Light"
                    />
                </div>
                <div
                    class="p-8 transition-colors duration-200 shadow-2xl bg-pastel-light-400 rounded-xl dark:bg-pastel-dark-600"
                >
                    <div class="mb-8 text-center">
                        <h2
                            class="text-2xl font-bold text-pastel-dark-700 dark:text-pastel-light-500"
                        >
                            Selamat Datang!
                        </h2>
                        <p
                            class="mt-2 text-pastel-dark-700 dark:text-pastel-light-500"
                        >
                            Silakan masuk ke akun Anda
                        </p>
                    </div>

                    <transition name="fade">
                        <div
                            v-if="error"
                            class="flex items-center p-4 mb-6 text-sm border rounded-lg text-pastel-red-600 border-pastel-red-600 bg-pastel-red-100"
                        >
                            <span
                                class="mr-2 text-pastel-red-600 material-icons"
                                >error</span
                            >
                            {{ error }}
                        </div>
                    </transition>

                    <form @submit.prevent="handleLogin" class="space-y-6">
                        <div>
                            <label
                                for="email"
                                class="block mb-1 text-sm font-bold text-pastel-dark-700 dark:text-pastel-light-500"
                            >
                                Alamat Email
                            </label>
                            <div class="relative">
                                <input
                                    v-model="email"
                                    id="email"
                                    type="email"
                                    required
                                    class="input-login"
                                    :class="{ 'opacity-50': loading }"
                                    autocapitalize="off"
                                    autocorrect="off"
                                    autocomplete="off"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="password"
                                class="block mb-1 text-sm font-bold text-pastel-dark-700 dark:text-pastel-light-500"
                            >
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <input
                                    v-model="password"
                                    id="password"
                                    type="password"
                                    required
                                    autocomplete="off"
                                    autocapitalize="off"
                                    autocorrect="off"
                                    :class="{ 'opacity-50': loading }"
                                    class="input-login"
                                />
                            </div>
                        </div>

                        <button
                            type="submit"
                            :disabled="loading"
                            class="button-login"
                            :class="{
                                'loading': loading,
                            }"
                        >
                            <div
                                class="flex items-center justify-center font-bold"
                            >
                                <span
                                    v-if="loading"
                                    class="mr-2 material-icons animate-spin"
                                >
                                    sync
                                </span>
                                {{ loading ? "Masuk..." : "Masuk" }}
                            </div>
                        </button>

                        <div class="relative py-0">
                            <div class="absolute inset-0 flex items-center">
                                <div
                                    class="w-full border-t border-pastel-dark-500 dark:border-pastel-light-500"
                                ></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span
                                    class="px-2 text-pastel-dark-500 dark:text-pastel-light-500 bg-pastel-light-400 dark:bg-pastel-dark-600"
                                >
                                    Atau masuk dengan
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button
                                type="button"
                                @click="handleGoogleLogin"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm font-bold transition-colors duration-200 border border-gray-300 rounded-lg bg-pastel-light-400 dark:bg-pastel-dark-500 dark:border-pastel-dark-600 dark:text-pastel-light-400 hover:bg-pastel-light-600 dark:hover:bg-pastel-dark-400"
                            >
                                <img
                                    :src="'/assets/icons/icons8-google.svg'"
                                    class="w-5 h-5 mr-2"
                                    alt="Google Logo"
                                />
                                Google
                            </button>
                            <button
                                type="button"
                                @click="handleFacebookLogin"
                                disabled
                                class="relative flex items-center justify-center w-full px-4 py-2 text-sm font-bold text-pastel-light-400 transition-colors duration-200 bg-[#1877F2] rounded-lg hover:bg-[#0c60d3] cursor-not-allowed"
                                @mouseenter="showTooltip = true"
                                @mouseleave="showTooltip = false"
                            >
                                <img
                                    :src="'/assets/icons/icons8-facebook.svg'"
                                    class="w-5 h-5 mr-2"
                                    alt="Facebook Logo"
                                />
                                Facebook
                                <transition name="fade">
                                    <div
                                        v-if="showTooltip"
                                        class="absolute px-3 py-2 mb-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm bottom-full whitespace-nowrap"
                                    >
                                        Dalam pengembangan...
                                        <div
                                            class="absolute bottom-0 w-2 h-2 -mb-1 transform rotate-45 -translate-x-1/2 bg-gray-900 left-1/2"
                                        ></div>
                                    </div>
                                </transition>
                            </button>
                        </div>

                        <div class="flex flex-col items-center justify-center">
                            <router-link
                                to="/register"
                                class="text-sm font-bold text-pastel-blue-600 hover:text-pastel-blue-800 dark:text-pastel-blue-400 dark:hover:text-pastel-blue-500"
                            >
                                Belum Punya Akun? Daftar disini
                            </router-link>
                            <router-link
                                to="/"
                                title="Kembali ke beranda"
                                class="w-full py-3 mt-3 text-sm font-bold rounded-lg bg-pastel-red-800 hover:bg-pastel-red-700"
                            >
                                <div
                                    class="flex items-center justify-center font-bold text-pastel-light-100"
                                >
                                    <span class="mr-2 material-icons">
                                        home
                                    </span>
                                    Kembali ke beranda
                                </div>
                            </router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useThemeStore } from "@/stores/theme";
import { signInWithGoogle, signInWithFacebook } from "@/utils/firebase";
import { useRouter } from "vue-router";

const router = useRouter();
const authStore = useAuthStore();
const themeStore = useThemeStore();

const email = ref("");
const password = ref("");
const error = ref(null);
const loading = ref(false);
const showTooltip = ref(false);

const handleLogin = async () => {
    error.value = null;
    loading.value = true;

    try {
        const authData = await authStore.login({
            email: email.value,
            password: password.value,
        });

        router.push("/");
    } catch (err) {
        if (err.response) {
            error.value = err.response.data.message || "Invalid credentials";
        } else {
            error.value = "Unable to connect to server";
        }
    } finally {
        loading.value = false;
    }
};

const handleGoogleLogin = async () => {
    try {
        loading.value = true;
        error.value = null;

        const { user } = await signInWithGoogle();
        if (user) {
            if (!user.displayName) {
                throw new Error("Google login failed: Name not provided");
            }

            await authStore.loginWithGoogle({
                name: user.displayName || "",
                email: user.email,
                google_id: user.uid,
                photo: user.photoURL,
            });

            router.push("/administrator/dashboard");
        }
    } catch (err) {
        error.value = err.message || "Google login failed";
        console.error("Google login error:", err);
    } finally {
        loading.value = false;
    }
};

const handleFacebookLogin = async () => {
    try {
        loading.value = true;
        error.value = null;

        const { user, token } = await signInWithFacebook();

        if (!user.email) {
            throw new Error("Facebook login failed: Email not provided");
        }

        await authStore.loginWithFacebook({
            name: user.displayName,
            email: user.email,
            facebook_id: user.uid,
            photo: user.photoURL,
            access_token: token,
        });

        router.push("/administrator/dashboard");
    } catch (err) {
        error.value = err.message || "Facebook login failed";
    } finally {
        loading.value = false;
    }
};

const toggleTheme = () => {
    themeStore.toggleTheme();
};

onMounted(() => {
    themeStore.initTheme();
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
