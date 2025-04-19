<template>
    <dashboard-layout>
        <div class="mx-auto mb-4 ">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">space_dashboard</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">
                            Dashboard
                        </span>
                    </h1>
                </div>
            </header>
        </div>
        <div class="pb-3 mx-auto rounded-lg ">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Line Chart -->
                <div class="p-4 rounded-lg shadow bg-pastel-light-100 dark:bg-pastel-dark-700">
                    <h6 class="text-lg font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        Monthly Sales
                    </h6>
                    <line-chart :series="monthlySales" :categories="months">
                    </line-chart>
                </div>

                <!-- Bar Chart -->
                <div class="p-4 rounded-lg shadow bg-pastel-light-100 dark:bg-pastel-dark-700">
                    <h6 class="text-lg font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        Product Sales
                    </h6>
                    <bar-chart :series="productSales" :categories="products">
                    </bar-chart>
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DashboardLayout from '@/components/layouts/Sidebar.vue'
import LineChart from '@/components/charts/LineChart.vue'
import BarChart from '@/components/charts/BarChart.vue'
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import { storage } from '@/utils/storage'
import { STORAGE_KEYS } from '@/utils/constants'

const router = useRouter()
const authStore = useAuthStore()

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
const products = ['Product A', 'Product B', 'Product C', 'Product D', 'Product E']

const monthlySales = ref([
    {
        name: 'Current Year Sales',
        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
    },
    {
        name: 'Previous Year Sales',
        data: [25, 35, 30, 45, 40, 55, 65, 85, 110]
    }
])

const productSales = ref([
    {
        name: 'Current Month',
        data: [44, 55, 57, 56, 61]
    },
    {
        name: 'Previous Month',
        data: [35, 41, 36, 26, 45]
    }
])

onMounted(() => { })
</script>
