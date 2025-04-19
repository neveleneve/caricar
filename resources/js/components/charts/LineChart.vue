<template>
    <apexchart :type="type" :height="height" :options="chartOptions" :series="series"></apexchart>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import VueApexCharts from "vue3-apexcharts"
import { useThemeStore } from '@/stores/theme'
import { storeToRefs } from 'pinia'

const themeStore = useThemeStore()
const { isDark } = storeToRefs(themeStore)
const unsubscribe = ref(null)

const props = defineProps({
    type: {
        type: String,
        default: 'line'
    },
    height: {
        type: [String, Number],
        default: 350
    },
    series: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
})

const createChartOptions = (isDark) => ({
    chart: {
        type: 'line',
        animations: {
            enabled: true,
            easing: 'easeinout',
            speed: 800,
            animateGradually: {
                enabled: true,
                delay: 150
            },
            dynamicAnimation: {
                enabled: true,
                speed: 350
            }
        },
        foreColor: '#64748b',
        theme: {
            mode: isDark ? 'dark' : 'light'
        }
    },
    xaxis: {
        categories: props.categories
    },
    stroke: {
        curve: 'smooth',
        width: 3
    },
    colors: isDark ? 
        ['#C6D3E0', '#818CF8', '#34D399', '#FCD34D', '#F87171'] : 
        ['#6A7A8D', '#4F46E5', '#059669', '#D97706', '#DC2626'],
    legend: {
        show: true,
        position: 'top'
    }
})

const chartOptions = ref(createChartOptions(themeStore.isDark))

onMounted(() => {
    unsubscribe.value = themeStore.$subscribe((mutation, state) => {
        chartOptions.value = createChartOptions(state.isDark)
    })
})

onBeforeUnmount(() => {
    if (unsubscribe.value) {
        unsubscribe.value()
    }
})
</script>
