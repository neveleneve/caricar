<template>
    <dashboard-layout>
        <div class="container mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center justify-between gap-3">
                    <div
                        class="flex items-center text-2xl font-bold text-gray-800 dark:text-gray-200"
                    >
                        <h1
                            class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500"
                        >
                            <span class="material-icons">verified</span>
                            <span
                                class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500"
                                >Data Brand</span
                            >
                        </h1>
                    </div>
                    <router-link
                        :to="'/administrator/brand/create'"
                        class="flex items-center px-3 py-1 text-white bg-red-600 rounded-lg hover:bg-red-500"
                    >
                        <span class="material-icons">add</span>
                        <span class="ml-1">Tambah Brand</span>
                    </router-link>
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
                            placeholder="Cari brand..."
                            class="search-input-full"
                            id="pencarian"
                            name="pencarian"
                        />
                    </div>
                </div>
                <!-- desktop table -->
                <div class="hidden md:block">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <data-table
                                    :columns="columns"
                                    :items="brands"
                                    :loading="loading"
                                    :error="error"
                                    empty-message="Tidak ada data brand"
                                >
                                    <template #row="{ item: brand }">
                                        <td class="td">
                                            <img
                                                :src="`https://vl.imgix.net/img/${formatBrandName(
                                                    brand.name
                                                )}-logo.png`"
                                                class="object-cover max-w-16 h-10"
                                            />
                                            <!-- <i
                                                v-else
                                                class="text-2xl car-default"
                                            ></i> -->
                                        </td>
                                        <td class="td">
                                            {{ brand.name }}
                                        </td>
                                        <td class="td text-center">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="
                                                    brand.deleted_at
                                                        ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'
                                                        : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                                "
                                            >
                                                {{
                                                    brand.deleted_at
                                                        ? "Tidak Aktif"
                                                        : "Aktif"
                                                }}
                                            </span>
                                        </td>
                                        <td class="text-right td">
                                            <div
                                                class="relative inline-flex items-center justify-end gap-2"
                                            >
                                                <transition
                                                    enter-active-class="transition duration-100 ease-out"
                                                    enter-from-class="transform scale-95 opacity-0"
                                                    enter-to-class="transform scale-100 opacity-100"
                                                    leave-active-class="transition duration-75 ease-in"
                                                    leave-from-class="transform scale-100 opacity-100"
                                                    leave-to-class="transform scale-95 opacity-0"
                                                >
                                                    <div
                                                        v-show="
                                                            activeMenu ===
                                                            brand.id
                                                        "
                                                        class="absolute z-50 overflow-hidden border rounded-lg shadow-lg dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 -bottom-3 right-14 dark:bg-pastel-dark-800 w-36 menu-container"
                                                        @click.stop
                                                    >
                                                        <router-link
                                                            :to="`/administrator/brand/${brand.id}`"
                                                            class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700"
                                                        >
                                                            Ubah
                                                        </router-link>
                                                        <button
                                                            @click.stop="
                                                                handleDelete(
                                                                    brand.id,
                                                                    brand.name
                                                                )
                                                            "
                                                            :class="
                                                                brand.deleted_at
                                                                    ? 'block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-green-600 hover:bg-gray-100 dark:text-green-red-400 dark:hover:bg-pastel-dark-700'
                                                                    : 'block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-red-600 hover:bg-gray-100 dark:text-pastel-red-400 dark:hover:bg-pastel-dark-700'
                                                            "
                                                        >
                                                            {{
                                                                brand.deleted_at
                                                                    ? "Pulihkan"
                                                                    : "Hapus"
                                                            }}
                                                        </button>
                                                    </div>
                                                </transition>
                                                <button
                                                    @click.stop="
                                                        toggleMenu(
                                                            brand.id,
                                                            $event
                                                        )
                                                    "
                                                    class="font-bold btn btn-sm btn-blue btn-rounded"
                                                >
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
                <div class="md:hidden">
                    <div v-if="loading" class="flex justify-center p-4">
                        <div
                            class="w-6 h-6 border-2 border-t-2 rounded-full border-pastel-dark-300 border-t-pastel-dark-700 animate-spin"
                        ></div>
                    </div>

                    <div
                        v-else-if="error"
                        class="p-4 text-center text-pastel-red-600 dark:text-pastel-red-400"
                    >
                        {{ error }}
                    </div>

                    <div
                        v-else-if="brands.length === 0"
                        class="p-4 text-center text-pastel-dark-600 dark:text-pastel-dark-300"
                    >
                        Tidak ada data brand
                    </div>

                    <div v-else class="space-y-4">
                        <div
                            v-for="brand in brands"
                            :key="brand.id"
                            class="p-4 border rounded-lg shadow-sm dark:border-pastel-dark-500 bg-pastel-light-200 dark:bg-pastel-dark-800"
                        >
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img
                                        :src="`https://vl.imgix.net/img/${formatBrandName(
                                            brand.name
                                        )}-logo.png`"
                                        class="object-cover max-w-72 h-16"
                                    />
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-200"
                                    >
                                        {{ brand.name }}
                                    </p>
                                </div>

                                <div class="relative">
                                    <button
                                        @click.stop="
                                            toggleMenu(brand.id, $event)
                                        "
                                        class="font-bold btn btn-sm btn-blue btn-rounded"
                                    >
                                        Aksi
                                    </button>

                                    <transition
                                        enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0"
                                    >
                                        <div
                                            v-show="activeMenu === brand.id"
                                            class="absolute right-0 z-50 overflow-hidden border rounded-lg shadow-lg top-10 dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 dark:bg-pastel-dark-800 w-36 menu-container"
                                            @click.stop
                                        >
                                            <router-link
                                                :to="`/administrator/brand/${brand.id}`"
                                                class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700"
                                            >
                                                Ubah
                                            </router-link>
                                            <button
                                                @click.stop="
                                                    handleDelete(
                                                        brand.id,
                                                        brand.name
                                                    )
                                                "
                                                :class="
                                                    brand.deleted_at
                                                        ? 'block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-green-600 hover:bg-gray-100 dark:text-green-red-400 dark:hover:bg-pastel-dark-700'
                                                        : 'block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-red-600 hover:bg-gray-100 dark:text-pastel-red-400 dark:hover:bg-pastel-dark-700'
                                                "
                                            >
                                                {{
                                                    brand.deleted_at
                                                        ? "Pulihkan"
                                                        : "Hapus"
                                                }}
                                            </button>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Pagination
                    v-if="!loading && brands.length > 0"
                    :current-page="pagination.current_page"
                    :last-page="pagination.last_page"
                    :from="pagination.from"
                    :to="pagination.to"
                    :total="pagination.total"
                    @change-page="changePage"
                />
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DataTable from "@/components/layouts/DataTable.vue";
import Pagination from "@/components/layouts/Pagination.vue";
import DashboardLayout from "@/components/layouts/Sidebar.vue";
import { onMounted, ref, onUnmounted } from "vue";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";
import Swal from "sweetalert2";
import axios from "axios";

const brands = ref([]);
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

const formatBrandName = (name) => {
    return name.toLowerCase().replace(/\s+/g, "-");
};

const columns = [
    { key: "logo", label: "Logo" },
    { key: "name", label: "Nama Brand" },
    { key: "status", label: "Status", align: "center" },
    { key: "actions", label: "Aksi", align: "right" },
];

const fetchBrands = async (search = "", page = 1, dataTotal = 10) => {
    loading.value = true;
    error.value = null;
    try {
        const response = await axios.get("/api/brand", {
            params: {
                search: search,
                page: page,
                dataTotal: dataTotal,
            },
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        });
        brands.value = response.data.data.data;
        pagination.value = {
            current_page: response.data.data.current_page,
            last_page: response.data.data.last_page,
            from: response.data.data.from,
            to: response.data.data.to,
            total: response.data.data.total,
        };
    } catch (err) {
        error.value = err.response?.data?.message || err.message;
    } finally {
        loading.value = false;
    }
};

const handleSearch = () => {
    if (searchTimeout) clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        pagination.value.current_page = 1;
        fetchBrands(searchQuery.value, pagination.value.current_page);
    }, 300);
};

const changePage = (page) => {
    if (page >= 1 && page <= pagination.value.last_page) {
        fetchBrands(searchQuery.value, page);
    }
};

const toggleMenu = (itemId, event) => {
    event.stopPropagation();
    activeMenu.value = activeMenu.value === itemId ? null : itemId;
    activeItem.value = brands.value.find((b) => b.id === itemId);
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

const handleDelete = async (itemId, itemName) => {
    const result = await Swal.fire({
        title: "Konfirmasi Hapus",
        text: `Apakah Anda yakin ingin menghapus ${itemName}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#EF4444",
        cancelButtonColor: "#6B7280",
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
        background: document.documentElement.classList.contains("dark")
            ? "#1F2937"
            : "#fff",
        color: document.documentElement.classList.contains("dark")
            ? "#fff"
            : "#000",
    });

    if (result.isConfirmed) {
        try {
            const token = storage.getItem(STORAGE_KEYS.TOKEN);
            await axios.delete(`/api/brand/${itemId}`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });

            await Swal.fire({
                title: "Berhasil!",
                text: "Item berhasil dihapus",
                icon: "success",
                timer: 1500,
                background: document.documentElement.classList.contains("dark")
                    ? "#1F2937"
                    : "#fff",
                color: document.documentElement.classList.contains("dark")
                    ? "#fff"
                    : "#000",
            });

            await fetchBrands(searchQuery.value, pagination.value.current_page);
        } catch (error) {
            await Swal.fire({
                title: "Error!",
                text:
                    error.response?.data?.message ||
                    "Terjadi kesalahan saat menghapus item",
                icon: "error",
                background: document.documentElement.classList.contains("dark")
                    ? "#1F2937"
                    : "#fff",
                color: document.documentElement.classList.contains("dark")
                    ? "#fff"
                    : "#000",
            });
        }
        activeMenu.value = null;
        activeItem.value = null;
    }
};

onMounted(() => {
    fetchBrands();
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>
