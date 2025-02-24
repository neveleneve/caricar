<template>
    <dashboard-layout>
        <div class="container mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">space_dashboard</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">Dashboard</span>
                    </h1>
                </div>
            </header>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from '@/components/layouts/Sidebar.vue';
import { useAuthStore } from '@/stores/auth'
import { computed, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

export default {
    components: {
        DashboardLayout,
    },
    setup() {
        return {
        };
    },
};
</script>
