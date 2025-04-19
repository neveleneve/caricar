<template>
    <nav class="transition-colors duration-300 bg-pastel-light-100 dark:bg-pastel-dark-600">
        <div class="flex items-center justify-between px-2 py-3 mx-auto">
            <div class="flex items-center">
                <router-link to="/" class="flex">
                    <img :src="logoSrc" class="h-6 transition-all duration-300" :alt="logoAltText" />
                </router-link>
            </div>
            <div class="flex items-center justify-end space-x-6">
                <nav v-if="!loggedIn" class="flex items-center space-x-4">
                    <router-link to="/login" class="nav-link">
                        <span class="text-xl material-icons">login</span>
                        <span class="text-sm font-medium">Masuk</span>
                    </router-link>
                    <span
                        class="hidden text-sm font-light text-pastel-dark-300 dark:text-pastel-light-400 md:block">|</span>
                    <router-link to="/register" class="nav-link">
                        <span class="text-xl material-icons">person_add</span>
                        <span class="text-sm font-medium">Daftar</span>
                    </router-link>
                    <router-link to="/sell" class="sell-link">
                        Jual Kendaraan Anda
                    </router-link>
                    <button @click="toggleTheme" class="theme-button">
                        <i class="material-icons theme-icon" :class="themeIconClass">
                            {{ themeIcon }}
                        </i>
                    </button>
                </nav>
                <nav v-else class="flex items-center space-x-4">
                    <router-link v-if="user.role == 'administrator'" to="/administrator/dashboard" class="nav-link">
                        <span class="text-xl material-icons">home</span>
                        <span class="text-sm font-bold">Dashboard</span>
                    </router-link>
                    <router-link to="/sell" class="sell-link">
                        Jual Kendaraan Anda
                    </router-link>
                    <button @click="toggleTheme" class="theme-button">
                        <i class="material-icons theme-icon" :class="themeIconClass">
                            {{ themeIcon }}
                        </i>
                    </button>
                    <button @click="logout" :disabled="isLoggingOut" :class="{
                        'opacity-75 cursor-not-allowed': isLoggingOut,
                    }" class="logout-button">
                        <span v-if="isLoggingOut" class="material-icons animate-spin">sync</span>
                        <span v-else class="material-icons">power_settings_new</span>
                    </button>
                </nav>
            </div>
        </div>
        <div class="transition-colors duration-300 bg-pastel-blue-600 dark:bg-pastel-blue-700 text-pastel-light-100">
            <div class="flex items-center justify-between px-4 py-3 mx-auto">
                <ul class="hidden space-x-6 text-sm md:flex">
                    <li v-for="(link, index) in menuLinks" :key="index">
                        <router-link :to="link.to" class="font-bold transition-colors hover:text-pastel-light-300">
                            {{ link.text }}
                        </router-link>
                    </li>
                </ul>
                <button @click="toggleMobileMenu" class="transition-colors md:hidden text-pastel-light-100"
                    aria-label="Toggle mobile menu">
                    <i class="material-icons">{{
                        isMobileMenuOpen ? "close" : "menu"
                        }}</i>
                </button>
            </div>
        </div>
        <transition enter-active-class="transition-all duration-500 ease-in-out"
            enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition-all duration-300 ease-in-out"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <div v-show="isMobileMenuOpen"
                class="fixed inset-0 z-50 p-4 overflow-auto origin-top bg-pastel-light-400 dark:bg-pastel-dark-500 border-pastel-dark-200/20 dark:border-pastel-light-200/20 backdrop-blur-lg bg-opacity-90">
                <ul class="mx-auto divide-y divide-pastel-dark-300 dark:divide-pastel-dark-100">
                    <li>
                        <button
                            class="flex items-center justify-end w-full px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-600 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                            @click="closeMobileMenu">
                            <span class="ml-auto">Tutup</span>
                            <span class="text-xl material-icons">close</span>
                        </button>
                    </li>
                    <li v-for="(link, index) in menuLinks" :key="index">
                        <router-link :to="link.to"
                            class="flex items-center px-4 py-3 font-bold transition-colors text-pastel-dark-600 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                            @click="closeMobileMenu">
                            {{ link.text }}
                        </router-link>
                    </li>
                    <div v-if="!loggedIn" class="text-pastel-dark-600 dark:text-pastel-light-100">
                        <li>
                            <router-link to="/login"
                                class="flex items-center px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-600 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                                @click="closeMobileMenu">
                                <span class="text-xl material-icons">login</span>
                                <span>Masuk</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/register"
                                class="flex items-center px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-600 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                                @click="closeMobileMenu">
                                <span class="text-xl material-icons">person_add</span>
                                <span>Daftar</span>
                            </router-link>
                        </li>
                    </div>
                    <div v-else class="text-pastel-dark-600 dark:text-pastel-light-100">
                        <li>
                            <router-link v-if="user.role == 'administrator'" to="/administrator/dashboard"
                                class="flex items-center px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-700 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300">
                                <span class="text-xl material-icons">home</span>
                                <span>Dashboard</span>
                            </router-link>
                        </li>
                        <li>
                            <button @click="logout"
                                class="flex items-center px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-700 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300">
                                <span v-if="isLoggingOut" class="material-icons animate-spin">sync</span>
                                <span v-else class="material-icons">power_settings_new</span>
                                <span>Logout</span>
                            </button>
                        </li>
                    </div>
                    <li class="p-4">
                        <router-link to="/sell"
                            class="flex items-center justify-center w-full px-4 py-2 font-semibold transition-colors rounded text-pastel-light-100 bg-pastel-blue-600 hover:bg-pastel-blue-700"
                            @click="closeMobileMenu">
                            Jual Kendaraan Anda
                        </router-link>
                    </li>
                </ul>
            </div>
        </transition>
    </nav>
    <main class="pt-12">
        <slot></slot>
    </main>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { useThemeStore } from "@/stores/theme";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import Swal from "sweetalert2";

const isLoggingOut = ref(false);
const isMobileMenuOpen = ref(false);
const themeStore = useThemeStore();
const router = useRouter();
const authStore = useAuthStore();

let user;

const loggedIn = computed(() => authStore.isAuthenticated);

if (loggedIn) {
    user = authStore.user;
}

const logoSrc = computed(
    () => `/assets/logo/caricar-${themeStore.isDark ? "dark" : "light"}.png`
);
const logoAltText = computed(
    () => `Logo Caricar.id ${themeStore.isDark ? "Dark" : "Light"}`
);
const themeIcon = computed(() =>
    themeStore.isDark ? "light_mode" : "dark_mode"
);
const themeIconClass = computed(() => [
    themeStore.isDark ? "dark-to-light" : "light-to-dark",
    { "animate-theme": themeStore.isTransitioning },
]);

const menuLinks = [
    { to: "/mobil-baru", text: "Mobil Baru" },
    { to: "/mobil-bekas", text: "Mobil Bekas" },
    { to: "/motor-baru", text: "Motor Baru" },
    { to: "/motor-bekas", text: "Motor Bekas" },
];

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false;
};

const toggleTheme = () => {
    themeStore.toggleTheme();
};

const routeChangeHandler = () => {
    closeMobileMenu();
};

const getSwalConfig = (options = {}) => ({
    background: themeStore.isDark ? "#1F2937" : "#fff",
    color: themeStore.isDark ? "#fff" : "#000",
    ...options,
});

const logout = async () => {
    closeMobileMenu();
    try {
        const result = await Swal.fire(
            getSwalConfig({
                title: "Konfirmasi Logout",
                text: "Apakah Anda yakin ingin keluar?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Ya, Logout",
                cancelButtonText: "Batal",
            })
        );

        if (result.isConfirmed) {
            isLoggingOut.value = true;
            await authStore.logout();
            await Swal.fire(
                getSwalConfig({
                    title: "Berhasil Logout!",
                    text: "Anda telah keluar dari sistem",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                })
            );
            router.push("/");
        }
    } catch (error) {
        console.error("Logout failed:", error);
        await Swal.fire(
            getSwalConfig({
                title: "Error!",
                text: error.response?.data?.message || "Gagal melakukan logout",
                icon: "error",
            })
        );
    } finally {
        isLoggingOut.value = false;
    }
};

onMounted(() => {
    themeStore.initTheme();
    router.afterEach(routeChangeHandler);
});

onBeforeUnmount(() => {
    router.afterEach(routeChangeHandler);
});
</script>

<style scoped>
.theme-icon {
    display: inline-block;
    transform: rotate(0deg);
}

.animate-theme {
    animation-duration: 500ms;
    animation-fill-mode: forwards;
    animation-timing-function: ease-in-out;
}

.dark-to-light.animate-theme {
    animation-name: spinToSun;
}

.light-to-dark.animate-theme {
    animation-name: spinToMoon;
}

@keyframes spinToSun {
    100% {
        transform: rotate(360deg);
    }
}

@keyframes spinToMoon {
    0% {
        transform: rotate(0deg);
    }

    50% {
        transform: rotate(-45deg);
    }

    100% {
        transform: rotate(0deg);
    }
}
</style>
