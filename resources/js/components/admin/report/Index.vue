<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">summarize</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">
                            Report
                        </span>
                    </h1>
                </div>
            </header>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DashboardLayout from '@/components/layouts/Sidebar.vue'
import { useAuthStore } from '@/stores/auth'
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { storage } from '@/utils/storage'
import { STORAGE_KEYS } from '@/utils/constants'

const router = useRouter()
const authStore = useAuthStore()

const userRole = computed(() => {
    const auth = storage.getItem(STORAGE_KEYS.AUTH)
    return auth?.role || 'User'
})

onMounted(() => {
    if (!authStore.isAuthenticated || !storage.getItem(STORAGE_KEYS.AUTH)) {
        authStore.clearAuth()
        router.push('/login')
    }
})
</script>
