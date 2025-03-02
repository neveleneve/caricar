<template>
    <nav
        class="transition-colors duration-300 text-pastel-dark-700 bg-pastel-light-100 dark:text-pastel-light-100 dark:bg-pastel-dark-600">
        <div class="container flex items-center justify-between px-2 py-3 mx-auto">
            <div class="flex items-center">
                <router-link to="/" class="flex">
                    <img :src="`/assets/logo/caricar-${themeStore.isDark ? 'dark' : 'light'}.png`"
                        class="h-6 transition-all duration-300" :alt="logoAltText" />
                </router-link>
            </div>
            <div class="flex items-center justify-end space-x-6">
                <nav v-if="!loggedIn" class="flex items-center space-x-4">
                    <router-link to="/login"
                        class="items-center hidden space-x-1 transition-colors md:flex text-pastel-dark-500 dark:text-pastel-light-300 hover:text-pastel-blue-500 dark:hover:text-pastel-blue-300">
                        <span class="text-xl material-icons">login</span>
                        <span class="text-sm font-medium">Masuk</span>
                    </router-link>
                    <span
                        class="hidden text-sm font-light text-pastel-dark-300 dark:text-pastel-light-400 md:block">|</span>
                    <router-link to="/register"
                        class="items-center hidden space-x-1 transition-colors md:flex text-pastel-dark-500 dark:text-pastel-light-300 hover:text-pastel-blue-500 dark:hover:text-pastel-blue-300">
                        <span class="text-xl material-icons">person_add</span>
                        <span class="text-sm font-medium">Daftar</span>
                    </router-link>
                </nav>
                <nav v-else class="flex items-center space-x-4">
                    <router-link to="/administrator/dashboard"
                        class="items-center hidden space-x-1 transition-colors md:flex text-pastel-dark-500 dark:text-pastel-light-300 hover:text-pastel-blue-500 dark:hover:text-pastel-blue-300">
                        <span class="text-xl material-icons">home</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </router-link>
                </nav>
                <router-link to="/sell"
                    class="items-center hidden px-4 py-2 font-semibold transition-colors rounded md:flex text-pastel-light-100 bg-pastel-red-600 hover:bg-pastel-red-700 dark:bg-pastel-red-700 dark:hover:bg-pastel-red-800">
                    Jual Kendaraan Anda
                </router-link>
                <button @click="toggleTheme"
                    class="p-2 transition-colors rounded-lg text-pastel-dark-400 dark:text-pastel-light-400 hover:bg-pastel-dark-200/20 dark:hover:bg-pastel-light-200/20"
                    :aria-label="themeButtonLabel">
                    <i class="material-icons theme-icon" :class="[
                        themeStore.isDark ? 'dark-to-light' : 'light-to-dark',
                        { 'animate-theme': themeStore.isTransitioning }
                    ]">
                        {{ themeStore.isDark ? 'light_mode' : 'dark_mode' }}
                    </i>
                </button>
            </div>
        </div>
        <div class="transition-colors duration-300 bg-pastel-blue-600 dark:bg-pastel-blue-700 text-pastel-light-100">
            <div class="container flex items-center justify-between px-4 py-3 mx-auto">
                <ul class="hidden space-x-6 text-sm md:flex">
                    <li v-for="(link, index) in menuLinks" :key="index">
                        <router-link :to="link.to" class="font-bold transition-colors hover:text-pastel-light-300">
                            {{ link.text }}
                        </router-link>
                    </li>
                </ul>
                <button @click="toggleMobileMenu" class="transition-colors md:hidden text-pastel-light-100"
                    aria-label="Toggle mobile menu">
                    <i class="material-icons">{{ isMobileMenuOpen ? 'close' : 'menu' }}</i>
                </button>
            </div>
        </div>
        <transition enter-active-class="transition-all duration-500 ease-in-out"
            enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition-all duration-300 ease-in-out"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <div v-show="isMobileMenuOpen"
                class="overflow-hidden origin-top md:hidden bg-pastel-blue-400 dark:bg-pastel-blue-700 border-pastel-dark-200/20 dark:border-pastel-light-200/20">
                <ul class="container mx-auto divide-y divide-pastel-dark-200/20 dark:divide-pastel-light-200/20">
                    <li v-for="(link, index) in menuLinks" :key="index">
                        <router-link :to="link.to"
                            class="flex items-center px-4 py-3 font-bold transition-colors text-pastel-dark-700 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                            @click="closeMobileMenu">
                            {{ link.text }}
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/login"
                            class="flex items-center px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-700 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                            @click="closeMobileMenu">
                            <span class="text-xl material-icons">login</span>
                            <span>Masuk</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/register"
                            class="flex items-center px-4 py-3 font-bold transition-colors gap-x-2 text-pastel-dark-700 hover:text-pastel-blue-600 dark:text-pastel-light-100 dark:hover:text-pastel-blue-300"
                            @click="closeMobileMenu">
                            <span class="text-xl material-icons">person_add</span>
                            <span>Daftar</span>
                        </router-link>
                    </li>
                    <li class="p-4">
                        <router-link to="/sell"
                            class="flex items-center justify-center w-full px-4 py-2 font-semibold transition-colors rounded text-pastel-light-100 bg-pastel-red-600 hover:bg-pastel-red-700 dark:bg-pastel-red-700 dark:hover:bg-pastel-red-800"
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
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useThemeStore } from '@/stores/theme';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth'
import { storage } from '@/utils/storage'
import { STORAGE_KEYS } from '@/utils/constants'

const isMobileMenuOpen = ref(false);
const themeStore = useThemeStore();
const router = useRouter();
const authStore = useAuthStore()

const loggedIn = authStore.isAuthenticated

let user = computed(() => {
    return []
})

if (loggedIn) {
    user = computed(() => {
        return authStore.user;
    });
}

console.log([
    authStore.isAuthenticated,
    storage.getItem(STORAGE_KEYS.AUTH),
    user.name,
]);

const menuLinks = [
    { to: '/mobil-baru', text: 'Mobil Baru' },
    { to: '/mobil-bekas', text: 'Mobil Bekas' },
    { to: '/motor-baru', text: 'Motor Baru' },
    { to: '/motor-bekas', text: 'Motor Bekas' },
];

const logoAltText = computed(() => `Logo Caricar.id ${themeStore.isDark ? 'Dark' : 'Light'}`);
const themeButtonLabel = computed(() => `Switch to ${themeStore.isDark ? 'light' : 'dark'} mode`);

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

onMounted(() => {
    themeStore.initTheme();
    // console.log(user);
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
