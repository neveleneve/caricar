<template>
    <div class="min-h-screen transition-all duration-500 bg-pastel-light-100 dark:bg-pastel-dark-600">
        <nav class="navbar">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button @click="toggleSidebar"
                            class="flex items-center p-2 text-gray-600 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-pastel-dark-500 lg:hidden hover:text-gray-900 hover:bg-pastel-light-800 dark:hover:bg-pastel-dark-600 dark:text-gray-400">
                            <span class="transition-transform duration-300 material-icons"
                                :class="{ 'rotate-90': sidebarOpen }">
                                {{ sidebarOpen ? 'close' : 'menu' }}
                            </span>
                        </button>
                        <div class="flex ml-2 md:mr-24">
                            <img v-if="themeStore.isDark" :src="'/assets/logo/caricar-dark.png'" class="h-6"
                                alt="Logo Caricar.id Dark" />
                            <img v-else :src="'/assets/logo/caricar-light.png'" class="h-6"
                                alt="Logo Caricar.id Light" />
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button @click="toggleTheme" :disabled="themeStore.isTransitioning"
                            class="flex items-center p-2 mr-4 text-gray-500 transition-opacity rounded-lg focus:outline-none focus:ring-2 focus:ring-pastel-dark-500 dark:text-gray-400 hover:bg-pastel-light-800 dark:hover:bg-pastel-dark-600"
                            :class="{ 'opacity-50 cursor-wait': themeStore.isTransitioning }">
                            <span class="material-icons theme-icon" :class="[
                                themeStore.isDark ? 'dark-to-light' : 'light-to-dark',
                                { 'animate-theme': themeStore.isTransitioning }
                            ]">
                                {{ themeStore.isDark ? 'light_mode' : 'dark_mode' }}
                            </span>
                        </button>

                        <div
                            class="items-center hidden mr-2 font-sans font-bold text-gray-700 dark:text-gray-300 text-md md:flex">
                            Welcome, {{ user?.name || 'User' }}
                        </div>

                        <div class="flex items-center ml-3">
                            <button @click="logout" :disabled="isLoggingOut"
                                class="px-2 py-2 text-sm font-bold text-white border-transparent rounded-lg bg-pastel-red-600 hover:bg-pastel-red-500 focus:outline-none focus:ring-2 focus:ring-pastel-red-300"
                                :class="{ 'opacity-75 cursor-not-allowed': isLoggingOut }">
                                <div class="flex items-center justify-center">
                                    <span v-if="isLoggingOut" class="material-icons animate-spin">
                                        sync
                                    </span>
                                    <span v-else class="material-icons">
                                        power_settings_new
                                    </span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <aside class="sidebar" :class="{ 'open': sidebarOpen, 'close': !sidebarOpen }">
            <div class="flex flex-col flex-1 overflow-y-auto">
                <div
                    class="flex-1 px-3 py-4 space-y-1 transition-colors duration-500 bg-pastel-light-100 dark:bg-pastel-dark-700">
                    <ul class="py-4 space-y-2">
                        <li>
                            <router-link to="/administrator/dashboard" class="sidebar-item" :class="[$route.path === '/administrator/dashboard'
                                ? 'active'
                                : 'inactive']">
                                <span class="material-icons">space_dashboard</span>
                                <span class="ml-3">Dashboard</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/administrator/brand" class="sidebar-item" :class="[$route.path.includes('/administrator/brand')
                                ? 'active'
                                : 'inactive']">
                                <span class="material-icons">verified</span>
                                <span class="ml-3">Brand</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/administrator/user" class="sidebar-item" :class="[$route.path.includes('/administrator/user')
                                ? 'active'
                                : 'inactive']">
                                <span class="material-icons">people</span>
                                <span class="ml-3">Pengguna</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/administrator/item" class="sidebar-item" :class="[$route.path.includes('/administrator/item')
                                ? 'active'
                                : 'inactive']">
                                <span class="material-icons">inventory</span>
                                <span class="ml-3">List Jual</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/administrator/item" class="sidebar-item" :class="[$route.path.includes('/administrator/item')
                                ? 'active'
                                : 'inactive']">
                                <span class="material-icons">receipt_long</span>
                                <span class="ml-3">Transaksi</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <div class="flex pt-16 overflow-hidden transition-all duration-500 bg-pastel-light-600 dark:bg-pastel-dark-600">
            <div class="fixed inset-0 z-10" v-if="sidebarOpen" @click="toggleSidebar"></div>
            <div id="main-content"
                class="relative w-full h-full overflow-y-auto transition-all duration-500 bg-pastel-light-600 dark:bg-pastel-dark-600 lg:ml-64">
                <main class="px-4 pt-6 pb-0 border-none">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import { useThemeStore } from '@/stores/theme';
import Swal from 'sweetalert2';

export default {
    setup() {
        const sidebarOpen = ref(false);
        const isLoggingOut = ref(false);
        const router = useRouter();
        const authStore = useAuthStore();
        const themeStore = useThemeStore();
        const user = computed(() => {
            return authStore.user;
        });
        const getSwalConfig = (options = {}) => ({
            background: themeStore.isDark ? '#1F2937' : '#fff',
            color: themeStore.isDark ? '#fff' : '#000',
            ...options
        });

        themeStore.initTheme()

        onMounted(async () => {
            const isValid = await authStore.verifyToken();
            if (!isValid) {
                router.push('/login');
            }
        });

        const toggleTheme = () => {
            themeStore.toggleTheme();
        }

        const toggleSidebar = () => {
            sidebarOpen.value = !sidebarOpen.value;
        }

        const logout = async () => {
            try {
                const result = await Swal.fire(getSwalConfig({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah Anda yakin ingin keluar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal',
                }));

                if (result.isConfirmed) {
                    isLoggingOut.value = true;
                    await authStore.logout();
                    await Swal.fire(getSwalConfig({
                        title: 'Berhasil Logout!',
                        text: 'Anda telah keluar dari sistem',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    }));
                    router.push('/login');
                }
            } catch (error) {
                console.error('Logout failed:', error);
                await Swal.fire(getSwalConfig({
                    title: 'Error!',
                    text: error.response?.data?.message || 'Gagal melakukan logout',
                    icon: 'error'
                }));
            } finally {
                isLoggingOut.value = false;
            }
        };

        return {
            sidebarOpen,
            toggleSidebar,
            logout,
            user,
            isLoggingOut,
            themeStore,
            toggleTheme,
        }
    }
}
</script>

<style scoped>
:deep(*) {
    transition: background-color 300ms ease-in-out,
        border-color 300ms ease-in-out,
        color 300ms ease-in-out;
}

:deep(.dark) [class*="dark:"] {
    transition: background-color 300ms ease-in-out,
        border-color 300ms ease-in-out,
        color 300ms ease-in-out;
}

.router-link-active {
    font-weight: 600;
}

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
