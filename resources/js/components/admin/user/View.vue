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
        <div class="pb-3 mx-auto rounded-lg">
            <div class="p-6 rounded-lg shadow-md bg-pastel-light-100 dark:bg-pastel-dark-700">
                <div class="flex mb-6">
                    <router-link :to="{ name: 'user_index' }">
                        <button
                            class="flex items-center px-3 py-1.5 text-sm font-semibold text-white bg-pastel-red-600 rounded-lg hover:bg-pastel-red-700 focus:outline-none focus:ring-2 focus:ring-pastel-dark-500">
                            <span class="material-icons">chevron_left</span>
                        </button>
                    </router-link>
                </div>
                <div v-if="penggunaLoading" class="text-center">
                    <span class="text-3xl text-gray-700 material-icons animate-spin dark:text-gray-300">
                        autorenew
                    </span>
                    <p class="text-gray-600 dark:text-gray-400">Loading...</p>
                </div>
                <div v-if="penggunaError" class="text-red-500">Error: {{ penggunaError }}</div>
                <div v-if="user && !penggunaLoading && !penggunaError" class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h1 class="text-3xl font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                            Detail Pengguna
                        </h1>
                        <hr class="h-px border-0 bg-pastel-dark-300 dark:bg-pastel-dark-600">
                    </div>
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
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
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
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
                <div class="pt-5 space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h1 class="text-3xl font-extrabold text-pastel-dark-700 dark:text-pastel-light-500">
                            Item
                        </h1>
                        <hr class="h-px border-0 bg-pastel-dark-300 dark:bg-pastel-dark-600">
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="flex">
                            <div class="relative flex-1">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="w-5 h-5 text-gray-400 material-icons">search</span>
                                </span>
                                <input type="text" v-model="itemPenggunaSearchQuery" @input="itemPenggunaHandleSearch"
                                    placeholder="Cari item pengguna..." class="search-input-full" id="pencarian_item" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow"></div>
                                <data-table :columns="itemPenggunaColumns" :items="itemPengguna"
                                    :loading="itemPenggunaLoading" :error="itemPenggunaError"
                                    empty-message="Tidak ada item pengguna">
                                    <template #row="{ item }">
                                        <td class="td">{{ item.name }}</td>
                                        <td class="hidden td lg:table-cell">{{ item.brand.name }}</td>
                                        <td class="hidden td lg:table-cell">
                                            {{ item.vehicle_type === 'car' ? 'Mobil' : 'Motor' }}
                                        </td>
                                        <td class="hidden td lg:table-cell">{{ item.condition === 'new' ? 'Baru' :
                                            'Bekas' }}
                                        </td>
                                        <td class="text-right td">
                                            <router-link :to="{ name: 'item_view', params: { id: item.id } }">
                                                <button class="font-bold btn btn-sm btn-blue btn-rounded">
                                                    Detail
                                                </button>
                                            </router-link>
                                        </td>
                                    </template>
                                </data-table>
                            </div>
                        </div>
                    </div>
                    <Pagination v-if="!itemPenggunaLoading && itemPengguna.length > 0"
                        :current-page="itemPenggunaPagination.current_page"
                        :last-page="itemPenggunaPagination.last_page" :from="itemPenggunaPagination.from"
                        :to="itemPenggunaPagination.to" :total="itemPenggunaPagination.total"
                        @change-page="itemPenggunaChangePage" />
                </div>
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import Pagination from "@/components/layouts/Pagination.vue";
import DataTable from '@/components/layouts/DataTable.vue';
import DashboardLayout from '@/components/layouts/Sidebar.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { storage } from '@/utils/storage';
import { STORAGE_KEYS } from '@/utils/constants';
import { useRoute } from "vue-router";
import router from '@/router';

const route = useRoute();
// Pengguna Section
const userId = ref(null);
const user = ref({});
const penggunaError = ref(null);
const penggunaLoading = ref(true);

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
        penggunaLoading.value = false;
    }
};

// Item Pengguna Section
const itemPengguna = ref([]);
const itemPenggunaSearchQuery = ref("");
let itemPenggunaSearchTimeout = null;
const itemPenggunaError = ref(null);
const itemPenggunaLoading = ref(true);
const itemPenggunaPagination = ref({
    current_page: 1,
    last_page: 1,
    from: 0,
    to: 0,
    total: 0,
});
const itemPenggunaColumns = [
    { key: "name", label: "Nama Item" },
    { key: "brand", label: "Brand", class: 'hidden lg:table-cell' },
    { key: "vehicle_type", label: "Tipe Kendaraan", class: 'hidden lg:table-cell' },
    { key: "condition", label: "Kondisi", class: 'hidden lg:table-cell' },
    { key: "actions", label: "Aksi", align: "right" },
];
const fetchItemPengguna = async (user_id, search = "", page = 1, dataTotal = 10) => {
    itemPenggunaLoading.value = true;
    itemPenggunaError.value = null;
    try {
        const response = await axios.get(`/api/items/user/${user_id}`, {
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
            params: {
                search: search,
                page: page,
                dataTotal: dataTotal
            }
        });
        if (!response.data || !response.data.data) {
            throw new Error("Item pengguna tidak ditemukan");
        }
        itemPengguna.value = response.data.data.data;
        itemPenggunaPagination.value = {
            current_page: response.data.data.current_page,
            last_page: response.data.data.last_page,
            from: response.data.data.from,
            to: response.data.data.to,
            total: response.data.data.total,
        };
    } catch (err) {
        if (err.response && err.response.status === 404) {
            router.push("/404");
            return;
        } else {
            itemPenggunaError.value = err.response?.data?.message || err.message;
        }
    } finally {
        itemPenggunaLoading.value = false;
    }
}
const itemPenggunaHandleSearch = () => {
    if (itemPenggunaSearchTimeout) {
        clearTimeout(itemPenggunaSearchTimeout);
    }
    itemPenggunaSearchTimeout = setTimeout(() => {
        fetchItemPengguna(userId.value, itemPenggunaSearchQuery.value, itemPenggunaSearchQuery.value.current_page);
    }, 300);
};
const itemPenggunaChangePage = (page) => {
    if (page >= 1 && page <= itemPenggunaPagination.value.last_page) {
        fetchItemPengguna(userId.value, itemPenggunaSearchQuery.value, page);
    }
};

onMounted(() => {
    userId.value = route.params.id;
    fetchPengguna();
    fetchItemPengguna(userId.value);
});
</script>
