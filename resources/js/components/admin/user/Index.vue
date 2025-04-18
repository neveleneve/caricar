<template>
    <dashboard-layout>
        <div class="mx-auto mb-4 container-lg">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">people</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">
                            Pengguna
                        </span>
                    </h1>
                </div>
            </header>
        </div>
        <div class="pb-3 mx-auto rounded-lg container-lg">
            <div class="p-4 rounded-lg bg-pastel-light-100 dark:bg-pastel-dark-700">
                <div class="flex mb-6">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="w-5 h-5 text-gray-400 material-icons">search</span>
                        </span>
                        <input type="text" v-model="searchQuery" @input="handleSearch" placeholder="Cari pengguna..."
                            class="search-input-full" id="pencarian" name="pencarian" />
                    </div>
                </div>
                <!-- desktop table -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <data-table :columns="columns" :items="pengguna" :loading="loading" :error="error"
                                    empty-message="Tidak ada pengguna">
                                    <template #row="{ item: pengguna }">
                                        <td class="td">
                                            {{ pengguna.name }}
                                        </td>
                                        <td class="td">
                                            {{ pengguna.email }}
                                        </td>
                                        <td class="td">
                                            <div class="flex items-center space-x-2">
                                                <img v-if="pengguna.google_id" :src="`/assets/icons/icons8-google.svg`"
                                                    class="w-5 h-5" alt="Google Logo" />
                                                <img v-if="pengguna.facebook_id"
                                                    :src="`/assets/icons/icons8-facebook-logo.svg`" class="w-5 h-5"
                                                    alt="Facebook Logo" />
                                            </div>
                                            <p v-if="!pengguna.google_id && !pengguna.facebook_id">-</p>
                                        </td>
                                        <td class="td">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pastel-blue-100 text-pastel-blue-800 dark:bg-pastel-blue-900 dark:text-pastel-blue-300">
                                                {{ pengguna.roles[0]?.name || "-" }}
                                            </span>
                                        </td>
                                        <td class="text-right td">
                                            <div class="relative inline-flex items-center justify-end gap-2">
                                                <transition enter-active-class="transition duration-100 ease-out"
                                                    enter-from-class="transform scale-95 opacity-0"
                                                    enter-to-class="transform scale-100 opacity-100"
                                                    leave-active-class="transition duration-75 ease-in"
                                                    leave-from-class="transform scale-100 opacity-100"
                                                    leave-to-class="transform scale-95 opacity-0">
                                                    <div v-show="activeMenu ===
                                                        pengguna.id
                                                        "
                                                        class="absolute z-50 overflow-hidden border rounded-lg shadow-lg dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 -bottom-3 right-14 dark:bg-pastel-dark-800 w-36 menu-container"
                                                        @click.stop>
                                                        <router-link :to="`/administrator/user/${pengguna.id}`"
                                                            class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700">
                                                            Ubah
                                                        </router-link>
                                                    </div>
                                                </transition>
                                                <button @click.stop="
                                                    toggleMenu(
                                                        pengguna.id,
                                                        $event
                                                    )
                                                    " class="font-bold btn btn-sm btn-blue btn-rounded">
                                                    Aksi
                                                </button>
                                            </div>
                                        </td>
                                    </template>
                                </data-table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:hidden">
                    <div v-if="loading" class="flex justify-center p-4">
                        <div
                            class="w-6 h-6 border-2 border-t-2 rounded-full border-pastel-dark-300 border-t-pastel-dark-700 animate-spin">
                        </div>
                    </div>

                    <div v-else-if="error" class="p-4 text-center text-pastel-red-600 dark:text-pastel-red-400">
                        {{ error }}
                    </div>

                    <div v-else-if="pengguna.length === 0"
                        class="p-4 text-center text-pastel-dark-600 dark:text-pastel-dark-300">
                        <span class="material-icons" style="font-size: 50px;">sentiment_dissatisfied</span>
                        <p class="mt-2">Tidak ada data pengguna</p>
                    </div>
                    <div v-else class="space-y-4">
                        <div v-for="peng in pengguna" :key="peng.id"
                            class="p-4 border rounded-lg shadow-sm dark:border-pastel-dark-500 bg-pastel-light-500 dark:bg-pastel-dark-700">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-md text-pastel-dark-700 dark:text-pastel-light-200">
                                        {{ peng.name }}
                                    </p>
                                    <p class="text-xs font-medium text-pastel-dark-700 dark:text-pastel-light-200">
                                        {{ peng.email }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pastel-blue-100 text-pastel-blue-800 dark:bg-pastel-blue-900 dark:text-pastel-blue-300">
                                            {{ peng.roles[0]?.name || "-" }}
                                        </span>
                                        <div class="flex items-center space-x-2">
                                            <img v-if="peng.google_id" :src="`/assets/icons/icons8-google.svg`"
                                                class="w-5 h-5" alt="Google Logo" />
                                            <img v-if="peng.facebook_id" :src="`/assets/icons/icons8-facebook-logo.svg`"
                                                class="w-5 h-5" alt="Facebook Logo" />
                                        </div>
                                    </div>
                                </div>
                                <div class="relative ml-4">
                                    <button @click.stop="toggleMenu(peng.id, $event)"
                                        class="p-2 text-gray-600 transition-colors rounded-full hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-pastel-dark-600">
                                        <span class="text-xl material-icons">more_vert</span>
                                    </button>
                                    <transition enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <div v-show="activeMenu === peng.id"
                                            class="absolute right-0 z-50 overflow-hidden border rounded-lg shadow-lg top-10 dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 dark:bg-pastel-dark-800 w-36 menu-container"
                                            @click.stop>
                                            <router-link :to="`/administrator/user/${peng.id}`"
                                                class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700">
                                                Ubah
                                            </router-link>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Pagination v-if="!loading && pengguna.length > 0" :current-page="pagination.current_page"
                    :last-page="pagination.last_page" :from="pagination.from" :to="pagination.to"
                    :total="pagination.total" @change-page="changePage" />
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DataTable from "@/components/layouts/DataTable.vue";
import Pagination from "@/components/layouts/Pagination.vue";
import DashboardLayout from "@/components/layouts/Sidebar.vue";
import { ref, onMounted, onUnmounted } from "vue";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";
import Swal from "sweetalert2";
import axios from "axios";

const pengguna = ref([]);
const activeMenu = ref(null);
const activeItem = ref(null);
const loading = ref(true);
const error = ref(null);
const searchQuery = ref("");
let searchTimeout = null;
const pagination = ref({
    current_page: 1,
    last_page: 1,
    from: 0,
    to: 0,
    total: 0,
});

const columns = [
    { key: "name", label: "Nama Lengkap" },
    { key: "email", label: "Email Pengguna" },
    { key: "social", label: "Social" },
    { key: "role", label: "Role Pengguna" },
    { key: "actions", label: "Aksi", align: "right" },
];

const fetchPengguna = async (search = "", page = 1, dataTotal = 10) => {
    loading.value = true;
    error.value = null;
    try {
        const response = await axios.get("/api/pengguna", {
            params: {
                search: search,
                page: page,
                dataTotal: dataTotal,
            },
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        });
        pengguna.value = response.data.data.data;
        pagination.value = {
            current_page: response.data.data.current_page,
            last_page: response.data.data.last_page,
            from: response.data.data.from,
            to: response.data.data.to,
            total: response.data.data.total,
        };
    } catch (err) {
        error.value = err.response ? err.response.data.message : err.message;
    } finally {
        loading.value = false;
    }
};

const handleSearch = () => {
    if (searchTimeout) clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        pagination.value.current_page = 1;
        fetchPengguna(searchQuery.value, pagination.value.current_page);
    }, 300);
};

const changePage = (page) => {
    if (page >= 1 && page <= pagination.value.last_page) {
        fetchPengguna(searchQuery.value, page);
    }
};

const toggleMenu = (itemId, event) => {
    event.stopPropagation();
    activeMenu.value = activeMenu.value === itemId ? null : itemId;
    activeItem.value = pengguna.value.find((b) => b.id === itemId);
};

const handleClickOutside = (event) => {
    const isClickedOutside =
        !event.target.closest(".menu-container") &&
        !event.target.closest("button");

    if (isClickedOutside && activeMenu.value !== null) {
        activeMenu.value = null;
        activeItem.value = null;
    }
};

onMounted(() => {
    fetchPengguna();
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>
