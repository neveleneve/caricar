<template>
    <div class="min-h-screen transition-all duration-500 bg-pastel-light-100 dark:bg-pastel-dark-600">
        <nav class="navbar">
            <div class="px-3 py-3 lg:py-4">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center justify-start lg:w-64">
                        <button @click="toggleSidebar"
                            class="flex items-center p-2 text-gray-600 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-pastel-dark-500 lg:hidden hover:text-gray-900 hover:bg-pastel-light-800 dark:hover:bg-pastel-dark-600 dark:text-gray-400">
                            <span class="transition-transform duration-300 material-icons"
                                :class="{ 'rotate-90': sidebarOpen }">
                                {{ sidebarOpen ? "close" : "menu" }}
                            </span>
                        </button>
                        <div class="flex items-center justify-center flex-1">
                            <router-link to="/" class="flex">
                                <img v-if="themeStore.isDark" :src="'/assets/logo/caricar-dark.png'" class="h-6"
                                    alt="Logo Caricar.id Dark" />
                                <img v-else :src="'/assets/logo/caricar-light.png'" class="h-6"
                                    alt="Logo Caricar.id Light" />
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <aside class="sidebar" :class="{ open: sidebarOpen, close: !sidebarOpen }">
            <div class="flex flex-col h-full">
                <div class="px-3 py-4 space-y-4 bg-pastel-light-100 dark:bg-pastel-dark-700">
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <div
                            class="flex items-center justify-center w-20 h-20 text-2xl text-white rounded-full bg-pastel-blue-700">
                            {{ user?.name?.charAt(0).toUpperCase() || 'U' }}
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="font-semibold text-md text-pastel-dark-700 dark:text-pastel-light-500">
                                {{ user?.name || 'User' }}
                            </div>
                            <div class="text-sm text-pastel-dark-500 dark:text-pastel-light-400">
                                {{ user?.email || 'user@example.com' }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg material-icons text-pastel-dark-700 dark:text-pastel-light-500">
                                {{ themeStore.isDark ? 'dark_mode' : 'light_mode' }}
                            </span>
                            <span class="text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500">
                                Dark Mode
                            </span>
                        </div>
                        <button @click="toggleTheme" :disabled="themeStore.isTransitioning"
                            class="relative inline-flex items-center w-12 h-6 transition-colors duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pastel-dark-500"
                            :class="{
                                'bg-pastel-light-700': !themeStore.isDark,
                                'bg-pastel-blue-700': themeStore.isDark,
                                'opacity-50 cursor-wait': themeStore.isTransitioning
                            }">
                            <span class="sr-only">Toggle theme</span>
                            <span
                                class="inline-block w-5 h-5 transition-transform duration-300 transform bg-white rounded-full shadow"
                                :class="{
                                    'translate-x-6': themeStore.isDark,
                                    'translate-x-1': !themeStore.isDark
                                }"></span>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col flex-1">
                    <div
                        class="flex-1 px-3 space-y-1 transition-colors duration-500 bg-pastel-light-100 dark:bg-pastel-dark-700">
                        <hr class="h-px border-0 bg-pastel-dark-300 dark:bg-pastel-dark-600">
                        <ul class="py-2 space-y-2">
                            <li>
                                <router-link :to="{ name: 'dashboard', params: {} }" class="sidebar-item" :class="[
                                    $route.path === '/administrator/dashboard'
                                        ? 'active'
                                        : 'inactive',
                                ]">
                                    <span class="material-icons">space_dashboard</span>
                                    <span class="ml-3 text-center">Dashboard</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'brand_index', params: {} }" class="sidebar-item" :class="[
                                    $route.path.includes('/administrator/brand')
                                        ? 'active'
                                        : 'inactive',
                                ]">
                                    <span class="material-icons">verified</span>
                                    <span class="ml-3">Data Brand</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'user_index', params: {} }" class="sidebar-item" :class="[
                                    $route.path.includes('/administrator/user')
                                        ? 'active'
                                        : 'inactive',
                                ]">
                                    <span class="material-icons">people</span>
                                    <span class="ml-3">Data Pengguna</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'item_index', params: {} }" class="sidebar-item" :class="[
                                    $route.path.includes('/administrator/item')
                                        ? 'active'
                                        : 'inactive',
                                ]">
                                    <span class="material-icons">directions_car</span>
                                    <span class="ml-3">Data Kendaraan</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'transaksi_index', params: {} }" class="sidebar-item" :class="[
                                    $route.path.includes(
                                        '/administrator/transaksi'
                                    )
                                        ? 'active'
                                        : 'inactive',
                                ]">
                                    <span class="material-icons">receipt_long</span>
                                    <span class="ml-3">Data Transaksi</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'report_index', params: {} }" class="sidebar-item" :class="[
                                    $route.path.includes(
                                        '/administrator/report'
                                    )
                                        ? 'active'
                                        : 'inactive',
                                ]">
                                    <span class="material-icons">summarize</span>
                                    <span class="ml-3">Report</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <hr class="h-px border-0 bg-pastel-light-700 dark:bg-pastel-dark-400">
                    <div class="px-3 py-4 mt-auto bg-pastel-light-100 dark:bg-pastel-dark-700">
                        <button @click="logout" :disabled="isLoggingOut"
                            class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium transition-colors duration-200 rounded-lg bg-pastel-red-600 text-pastel-light-300 hover:bg-pastel-red-700"
                            :class="{ 'opacity-75 cursor-not-allowed': isLoggingOut }">
                            <span class="font-black">Logout</span>
                            <span v-if="isLoggingOut" class="material-icons animate-spin">sync</span>
                            <span v-else class="material-icons">power_settings_new</span>
                        </button>
                    </div>
                </div>
            </div>
        </aside>
        <div class="flex pt-16 overflow-hidden transition-all duration-500 bg-pastel-light-600 dark:bg-pastel-dark-600">
            <div class="fixed inset-0 z-10" v-if="sidebarOpen" @click="toggleSidebar"></div>
            <div id="main-content"
                class="relative w-full overflow-y-auto transition-all duration-500 bg-pastel-light-600 dark:bg-pastel-dark-600 lg:ml-64"
                :style="{ height: 'calc(100vh - 4rem)' }">
                <main class="px-4 pt-6 pb-0 border-none">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useThemeStore } from "@/stores/theme";
import Swal from "sweetalert2";

const sidebarOpen = ref(false);
const isLoggingOut = ref(false);
const router = useRouter();
const authStore = useAuthStore();
const themeStore = useThemeStore();
const user = computed(() => {
    return authStore.user;
});
const getSwalConfig = (options = {}) => ({
    background: themeStore.isDark ? "#1F2937" : "#fff",
    color: themeStore.isDark ? "#fff" : "#000",
    ...options,
});

themeStore.initTheme();

onMounted(async () => {
    const isValid = await authStore.verifyToken();
    if (!isValid) {
        router.push("/login");
    }
});

const toggleTheme = () => {
    themeStore.toggleTheme();
};

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const logout = async () => {
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
            await authStore.logout();
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
</script>

<style scoped></style>
