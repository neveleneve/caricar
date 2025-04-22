<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <div class="flex items-center text-2xl font-bold text-gray-800 dark:text-gray-200">
                        <h1
                            class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                            <span class="material-icons">verified</span>
                            <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">Tambah Data Brand</span>
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

                <form @submit.prevent="addBrand" class="space-y-4">
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
                            class="px-4 py-2 text-sm font-semibold text-white rounded-lg bg-pastel-blue-800 hover:bg-pastel-blue-700 focus:outline-none focus:ring-2 focus:ring-pastel-dark-500">
                            Simpan
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
import { ref } from "vue";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";

const brand = ref({ name: "" });
import Swal from "sweetalert2";
import router from "@/router";

const addBrand = async () => {
    try {
        const response = await axios.post(
            `/api/brands`,
            {
                name: brand.value.name,
            },
            {
                headers: {
                    Authorization: `Bearer ${storage.getItem(
                        STORAGE_KEYS.TOKEN
                    )}`,
                },
            }
        );

        await Swal.fire({
            title: "Berhasil!",
            text: "Brand berhasil diupdate",
            icon: "success",
            timer: 1500,
            background: document.documentElement.classList.contains("dark")
                ? "#1F2937"
                : "#fff",
            color: document.documentElement.classList.contains("dark")
                ? "#fff"
                : "#000",
        });

        router.push("/administrator/brands");
    } catch (err) {
        Swal.fire({
            title: "Error!",
            text:
                err.response?.data?.message ||
                "Terjadi kesalahan saat mengupdate brand",
            icon: "error",
            background: document.documentElement.classList.contains("dark")
                ? "#1F2937"
                : "#fff",
            color: document.documentElement.classList.contains("dark")
                ? "#fff"
                : "#000",
        });
    }
};
</script>
