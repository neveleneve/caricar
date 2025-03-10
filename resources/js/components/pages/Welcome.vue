<template>
    <div>
        <Navbar>
            <div class="container px-4 mx-auto">
                <div class="py-12">
                    <div class="text-center">
                        <h1 class="mb-4 text-4xl font-bold text-pastel-dark-800 dark:text-pastel-light-100">
                            Welcome to Caricar
                        </h1>
                        <p class="mb-8 text-lg text-pastel-dark-600 dark:text-pastel-light-300">
                            Find your perfect car with ease
                        </p>
                        <div class="flex justify-center gap-4">
                            <button
                                class="px-6 py-3 font-semibold transition-colors rounded-lg bg-pastel-dark-700 text-pastel-light-100 hover:bg-pastel-dark-800">
                                Browse Cars
                            </button>
                            <button
                                class="px-6 py-3 font-semibold transition-colors border rounded-lg text-pastel-dark-700 dark:text-pastel-light-100 border-pastel-dark-700 dark:border-pastel-light-100 hover:bg-pastel-dark-700 hover:text-pastel-light-100 dark:hover:bg-pastel-light-100 dark:hover:text-pastel-dark-700">
                                Learn More
                            </button>
                        </div>
                    </div>
                    <div class="grid gap-8 mt-16 md:grid-cols-3">
                        <div v-for="(feature, index) in features" :key="index"
                            class="p-6 transition-all rounded-lg bg-pastel-light-200 dark:bg-pastel-dark-500 hover:shadow-lg">
                            <span class="text-3xl material-icons text-pastel-dark-700 dark:text-pastel-light-100">
                                {{ feature.icon }}
                            </span>
                            <h3 class="mt-4 mb-2 text-xl font-semibold text-pastel-dark-800 dark:text-pastel-light-100">
                                {{ feature.title }}
                            </h3>
                            <p class="text-pastel-dark-600 dark:text-pastel-light-300">
                                {{ feature.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </Navbar>
    </div>
</template>

<script setup>
import Navbar from '@/components/layouts/Navbar.vue'

const features = [
    {
        icon: 'directions_car',
        title: 'Wide Selection',
        description: 'Choose from our extensive collection of quality vehicles for every need and budget.'
    },
    {
        icon: 'verified',
        title: 'Verified Dealers',
        description: 'All our partner dealers are thoroughly vetted to ensure the best service.'
    },
    {
        icon: 'support_agent',
        title: '24/7 Support',
        description: 'Our customer support team is always ready to assist you with any queries.'
    }
]
</script>

<style scoped>
.container {
    max-width: 1200px;
}
</style>
