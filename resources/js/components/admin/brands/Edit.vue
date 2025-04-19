<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <div class="flex items-center text-2xl font-bold text-gray-800 dark:text-gray-200">
                        <h1
                            class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                            <span class="material-icons">verified</span>
                            <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">Ubah Data Brand</span>
                        </h1>
                    </div>
                </div>
            </header>
        </div>
        <div class="mx-auto rounded-lg">
            <div class="p-6 rounded-lg shadow-md bg-pastel-light-100 dark:bg-pastel-dark-700">
                <div class="flex mb-6">
                    <router-link :to="{ name: 'brand_index' }">
                        <button
                            class="flex items-center px-3 py-1.5 text-sm font-semibold text-white bg-pastel-red-600 rounded-lg hover:bg-pastel-red-700 focus:outline-none focus:ring-2 focus:ring-pastel-dark-500">
                            <span class="material-icons">chevron_left</span>
                        </button>
                    </router-link>
                </div>

                <div v-if="loading" class="text-center">
                    <span class="text-3xl text-gray-700 material-icons animate-spin dark:text-gray-300">
                        autorenew
                    </span>
                    <p class="text-gray-600 dark:text-gray-400">Loading...</p>
                </div>
                <div v-if="error" class="text-red-500">Error: {{ error }}</div>

                <form @submit.prevent="updateBrand" v-if="brand && !loading && !error" class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="brandName"
                                class="block text-sm font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">Nama
                                Brand</label>
                            <input id="brandName" v-model="brand.name"
                                class="w-full px-4 py-2 text-sm bg-white border rounded-lg dark:bg-pastel-dark-800 border-pastel-dark-300 dark:border-pastel-dark-600 text-pastel-dark-700 dark:text-pastel-light-500 focus:border-pastel-blue-800 focus:ring-pastel-blue-800 dark:focus:border-pastel-blue-700 dark:focus:ring-pastel-blue-700" />
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold text-white rounded-lg bg-pastel-blue-600 hover:bg-pastel-blue-700 focus:outline-none focus:ring-2 focus:ring-pastel-dark-500">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DashboardLayout from "@/components/layouts/Sidebar.vue";
import axios from "axios";
import { onMounted, ref } from "vue";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";
import { useRoute } from "vue-router";
import Swal from "sweetalert2";
import router from "@/router";

const brandId = ref(null);
const brand = ref({});
const error = ref(null);
const loading = ref(true);
const route = useRoute();
const fetchBrand = async () => {
    loading.value = true;
    error.value = null;
    try {
        const response = await axios.get(`/api/brand/${brandId.value}`, {
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        });
        if (!response.data || !response.data.data) {
            throw new Error("Brand tidak ditemukan");
        }
        brand.value = response.data.data;
    } catch (err) {
        if (err.response && err.response.status === 404) {
            router.push("/404");
            return;
        } else {
            error.value = err.response?.data?.message || err.message;
        }
        brand.value = null;
    } finally {
        loading.value = false;
    }
};
const updateBrand = async () => {
    const isDark = document.documentElement.classList.contains("dark");
    const token = storage.getItem(STORAGE_KEYS.TOKEN);

    try {
        await axios.put(
            `/api/brand/${brandId.value}`,
            { name: brand.value.name },
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );

        await Swal.fire({
            title: "Berhasil!",
            text: "Brand berhasil diupdate",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
            background: isDark ? "#1F2937" : "#fff",
            color: isDark ? "#fff" : "#000",
        });

        router.push("/administrator/brand");
    } catch (err) {
        const message =
            err.response?.data?.message || "Terjadi kesalahan saat mengupdate brand";

        Swal.fire({
            title: "Error!",
            text: message,
            icon: "error",
            background: isDark ? "#1F2937" : "#fff",
            color: isDark ? "#fff" : "#000",
        });
    }
};
onMounted(() => {
    brandId.value = route.params.id;
    fetchBrand();
});
</script>
