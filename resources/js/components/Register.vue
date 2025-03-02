<template>
    <div
        class="flex min-h-screen transition-colors duration-200 bg-gradient-to-br from-blue-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <button @click="toggleTheme" :disabled="themeStore.isTransitioning"
            class="absolute p-2 rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-700 top-4 right-4 dark:text-pastel-light-500 hover:bg-pastel-light-700 dark:hover:bg-pastel-dark-600"
            :class="{ 'opacity-50 cursor-wait': themeStore.isTransitioning }">
            <span class="material-icons theme-icon" :class="[
                themeStore.isDark ? 'dark-to-light' : 'light-to-dark',
                { 'animate-theme': themeStore.isTransitioning }
            ]">
                {{ themeStore.isDark ? 'light_mode' : 'dark_mode' }}
            </span>
        </button>
        <router-link to="/"
            class="absolute p-2 rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-700 top-4 right-16 dark:text-pastel-light-500 hover:bg-pastel-light-700 dark:hover:bg-pastel-dark-600">
            <span class="material-icons">
                home
            </span>
        </router-link>
        <div
            class="hidden w-1/2 transition-colors duration-200 bg-pastel-blue-600 dark:bg-pastel-blue-800 lg:flex lg:flex-col lg:justify-center lg:items-center">
            <div class="px-12 text-center">
                <div class="flex flex-col items-center">
                    <img :src="'/assets/logo/caricar-dark.png'" class="h-20 mb-1" alt="Logo Politeam Dark" />
                </div>
                <p class="text-xl text-blue-100">Your reliable payment system, simplified.</p>
            </div>
        </div>

        <div class="flex items-center justify-center w-full p-6 lg:w-1/2 bg-pastel-light-500 dark:bg-pastel-dark-700">
            <div class="w-full max-w-md space-y-8">
                <div class="flex flex-col items-center mb-10 lg:hidden">
                    <img v-if="themeStore.isDark" :src="'/assets/logo/caricar-dark.png'" class="h-9"
                        alt="Logo Caricar.id Dark" />
                    <img v-else :src="'/assets/logo/caricar-light.png'" class="h-9" alt="Logo Caricar.id Light" />
                </div>
                <div
                    class="p-8 transition-colors duration-200 shadow-2xl bg-pastel-light-400 rounded-xl dark:bg-pastel-dark-600">
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl font-bold text-pastel-dark-700 dark:text-pastel-light-500">Create Account
                        </h2>
                        <p class="mt-2 text-pastel-dark-700 dark:text-pastel-light-500">Please fill in your details</p>
                    </div>

                    <transition name="fade">
                        <div v-if="error"
                            class="flex items-center p-4 mb-6 text-sm border rounded-lg text-pastel-red-600 border-pastel-red-600 bg-pastel-red-100">
                            <span class="mr-2 text-pastel-red-600 material-icons">error</span>
                            {{ error }}
                        </div>
                    </transition>

                    <form @submit.prevent="handleRegister" class="space-y-6">
                        <div>
                            <label for="name"
                                class="block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500">
                                Full Name
                            </label>
                            <div class="relative">
                                <input v-model="name" id="name" type="text" required
                                    class="w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    :class="{ 'opacity-50': loading }" autocomplete="off">
                            </div>
                        </div>

                        <div>
                            <label for="email"
                                class="block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500">
                                Email Address
                            </label>
                            <div class="relative">
                                <input v-model="email" id="email" type="email" required
                                    class="w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    :class="{ 'opacity-50': loading }" autocapitalize="off" autocorrect="off"
                                    autocomplete="off">
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500">
                                Password
                            </label>
                            <div class="relative">
                                <input v-model="password" id="password" type="password" required autocomplete="off"
                                    autocapitalize="off" autocorrect="off" :class="{ 'opacity-50': loading }"
                                    class="w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <input v-model="password_confirmation" id="password_confirmation" type="password"
                                    required autocomplete="off" autocapitalize="off" autocorrect="off"
                                    :class="{ 'opacity-50': loading }"
                                    class="w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <button type="submit" :disabled="loading"
                            class="w-full py-3 transform rounded-lg text-pastel-light-500 bg-pastel-blue-500 hover:bg-pastel-blue-400 focus:outline-none focus:ring-2 focus:ring-pastel-blue-400 focus:ring-offset-2"
                            :class="{ 'opacity-75 cursor-not-allowed': loading }">
                            <div class="flex items-center justify-center font-bold">
                                <span v-if="loading" class="mr-2 material-icons animate-spin">
                                    sync
                                </span>
                                {{ loading ? 'Creating Account...' : 'Create Account' }}
                            </div>
                        </button>
                        <div class="mt-4 text-center">
                            <router-link to="/login"
                                class="text-sm text-pastel-blue-500 hover:text-pastel-blue-400 dark:text-pastel-blue-400 dark:hover:text-pastel-blue-300">
                                Sudah Punya Akun? Login disini
                            </router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { useThemeStore } from '@/stores/theme';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const authStore = useAuthStore();
const themeStore = useThemeStore();

// State management with ref
const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const error = ref(null);
const loading = ref(false);

onMounted(() => {
    themeStore.initTheme();
});

const toggleTheme = () => {
    themeStore.toggleTheme();
};

const handleRegister = async () => {
    error.value = null;
    loading.value = true;

    if (password.value !== password_confirmation.value) {
        error.value = 'Passwords do not match';
        loading.value = false;
        return;
    }

    try {
        await authStore.register({
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        });
        router.push('/administrator/dashboard');
    } catch (err) {
        if (err.response) {
            error.value = err.response.data.message || 'Registration failed';
        } else {
            error.value = 'Unable to connect to server';
        }
    } finally {
        loading.value = false;
    }
};
</script>
