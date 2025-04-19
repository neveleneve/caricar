<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">people</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">
                            Lihat Data Pengguna
                        </span>
                    </h1>
                </div>
            </header>
        </div>
        <div class="mx-auto rounded-lg">
            <div class="p-6 rounded-lg shadow-md bg-pastel-light-100 dark:bg-pastel-dark-700">
                <div class="flex mb-6">
                    <router-link :to="{ name: 'user_index' }">
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

                <div v-if="user && !loading && !error" class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h1 class="text-3xl font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                            Detail Pengguna
                        </h1>
                        <hr class="h-px border-0 bg-pastel-dark-300 dark:bg-pastel-dark-600">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="penggunaName"
                                class="block text-sm font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                                Nama Pengguna
                            </label>
                            <input id="penggunaName" v-model="user.name" readonly
                                class="w-full px-4 py-3 text-sm bg-white border rounded-lg cursor-not-allowed dark:bg-pastel-dark-800 border-pastel-dark-300 dark:border-pastel-dark-600 text-pastel-dark-700 dark:text-pastel-light-500 focus:border-pastel-blue-800 focus:ring-pastel-blue-800 dark:focus:border-pastel-blue-700 dark:focus:ring-pastel-blue-700" />
                        </div>
                        <div>
                            <label for="emailName"
                                class="block text-sm font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                                Email Pengguna
                            </label>
                            <input id="emailName" v-model="user.email" readonly
                                class="w-full px-4 py-3 text-sm bg-white border rounded-lg cursor-not-allowed dark:bg-pastel-dark-800 border-pastel-dark-300 dark:border-pastel-dark-600 text-pastel-dark-700 dark:text-pastel-light-500 focus:border-pastel-blue-800 focus:ring-pastel-blue-800 dark:focus:border-pastel-blue-700 dark:focus:ring-pastel-blue-700" />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="role"
                                class="block text-sm font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                                Role
                            </label>
                            <input id="role" v-model="user.roles[0].name" readonly
                                class="w-full px-4 py-3 text-sm bg-white border rounded-lg cursor-not-allowed dark:bg-pastel-dark-800 border-pastel-dark-300 dark:border-pastel-dark-600 text-pastel-dark-700 dark:text-pastel-light-500 focus:border-pastel-blue-800 focus:ring-pastel-blue-800 dark:focus:border-pastel-blue-700 dark:focus:ring-pastel-blue-700" />
                        </div>
                        <div>
                            <label for="googleID"
                                class="block text-sm font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                                Google ID
                            </label>
                            <input id="googleID" v-model="user.google_id" :placeholder="`-`" readonly
                                class="w-full px-4 py-3 text-sm bg-white border rounded-lg cursor-not-allowed dark:bg-pastel-dark-800 border-pastel-dark-300 dark:border-pastel-dark-600 text-pastel-dark-700 dark:text-pastel-light-500 focus:border-pastel-blue-800 focus:ring-pastel-blue-800 dark:focus:border-pastel-blue-700 dark:focus:ring-pastel-blue-700" />
                        </div>
                        <div>
                            <label for="facebookID"
                                class="block text-sm font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                                Facebook ID
                            </label>
                            <input id="facebookID" v-model="user.facebook_id" :placeholder="`-`" readonly
                                class="w-full px-4 py-3 text-sm bg-white border rounded-lg cursor-not-allowed dark:bg-pastel-dark-800 border-pastel-dark-300 dark:border-pastel-dark-600 text-pastel-dark-700 dark:text-pastel-light-500 focus:border-pastel-blue-800 focus:ring-pastel-blue-800 dark:focus:border-pastel-blue-700 dark:focus:ring-pastel-blue-700" />
                        </div>
                    </div>
                </div>
                <div v-if="user && !loading && !error && user.roles[0].name == 'pengguna'" class="pt-5 space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h1 class="text-3xl font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                            History Transaksi
                        </h1>
                        <hr class="h-px border-0 bg-pastel-dark-300 dark:bg-pastel-dark-600">
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <data-table :columns="columns" :items="transaksi" :loading="loading" :error="error"
                            empty-message="Tidak ada transaksi pengguna">
                        </data-table>
                    </div>
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DataTable from '@/components/layouts/DataTable.vue'
import DashboardLayout from '@/components/layouts/Sidebar.vue'
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { storage } from '@/utils/storage';
import { STORAGE_KEYS } from '@/utils/constants';
import { useRoute } from "vue-router";
import router from '@/router';

const transaksi = ref([]);
const activeMenu = ref(null);
const activeItem = ref(null);
const columns = [
    { key: "kode", label: "Kode Transaksi" },
    { key: "tanggal", label: "Tanggal Transaksi" },
    { key: "status", label: "Status Transaksi" },
    { key: "actions", label: "Aksi", align: "right" },
];
const userId = ref(null);
const user = ref({});
const error = ref(null);
const loading = ref(true);
const route = useRoute();
const fetchPengguna = async () => {
    try {
        const response = await axios.get(`/api/pengguna/${userId.value}`, {
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        });
        if (!response.data || !response.data.data) {
            throw new Error("Pengguna tidak ditemukan");
        }
        user.value = response.data.data;
    } catch (err) {
        if (err.response && err.response.status === 404) {
            router.push("/404");
            return;
        } else {
            error.value = err.response?.data?.message || err.message;
        }
    } finally {
        loading.value = false;
    }
};
onMounted(() => {
    userId.value = route.params.id;
    fetchPengguna();
});
</script>
