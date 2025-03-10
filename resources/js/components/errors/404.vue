<template>
    <div class="flex items-center min-h-screen transition-colors duration-200 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl px-4 mx-auto text-center">
            <div class="mb-8">
                <div class="mb-8 font-bold text-blue-600 dark:text-blue-400 text-9xl">404</div>
                <h2 class="mb-4 text-3xl font-semibold text-gray-800 dark:text-gray-100">Halaman Tidak Ditemukan</h2>
                <p class="mb-8 text-xl text-gray-600 dark:text-gray-400">Maaf, halaman yang Anda cari tidak dapat
                    ditemukan.</p>
                <router-link to="/"
                    class="inline-block px-8 py-3 font-semibold text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600">
                    Kembali ke Beranda
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import { useThemeStore } from '@/stores/theme';
import { onMounted } from 'vue'
export default {
    name: 'NotFound',
    setup() {
        const themeStore = useThemeStore()

        onMounted(() => {
            themeStore.initTheme()
        })

        return {
            isDark: themeStore.isDark
        }
    }
}
</script>
