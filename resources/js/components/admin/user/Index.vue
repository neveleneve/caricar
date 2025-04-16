<template>
    <dashboard-layout>
        <div class="container mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500"
                    >
                        <span class="material-icons">people</span>
                        <span
                            class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500"
                        >
                            Pengguna
                        </span>
                    </h1>
                </div>
            </header>
        </div>
        <div class="container mx-auto rounded-lg">
            <div
                class="p-4 rounded-lg bg-pastel-light-100 dark:bg-pastel-dark-700"
            >
                <div class="flex mb-6">
                    <div class="relative flex-1">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <span class="w-5 h-5 text-gray-400 material-icons"
                                >search</span
                            >
                        </span>
                        <input
                            type="text"
                            v-model="searchQuery"
                            @input="handleSearch"
                            placeholder="Cari pengguna..."
                            class="search-input-full"
                            id="pencarian"
                            name="pencarian"
                        />
                    </div>
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DashboardLayout from "@/components/layouts/Sidebar.vue";
import { useAuthStore } from "@/stores/auth";
import { computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";
import { Swal } from "sweetalert2";

const router = useRouter();
const authStore = useAuthStore();
</script>
