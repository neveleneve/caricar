<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center text-2xl font-bold text-gray-800 dark:text-gray-200">
                        <h1
                            class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                            <span class="material-icons">verified</span>
                            <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">Data Brand</span>
                        </h1>
                    </div>
                    <router-link :to="'/administrator/brands/create'"
                        class="flex items-center px-3 py-1 text-white rounded-lg bg-pastel-red-600 hover:bg-pastel-red-700">
                        <span class="material-icons">add</span>
                        <span class="ml-1 font-bold">Tambah</span>
                    </router-link>
                </div>
            </header>
        </div>
        <div class="pb-3 mx-auto rounded-lg">
            <div class="p-4 rounded-lg bg-pastel-light-100 dark:bg-pastel-dark-700">
                <div class="flex mb-6">
                    <div class="flex-1">
                        <label for="pencarian"
                            class="block mb-1 text-sm font-medium text-pastel-dark-600 dark:text-pastel-light-300">
                            Pencarian
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="w-5 h-5 text-gray-400 material-icons">search</span>
                            </span>
                            <input type="text" v-model="searchQuery" @input="handleSearch" placeholder="Cari brand..."
                                class="search-input-full" id="pencarian" />
                        </div>
                    </div>
                    <div class="ml-3">
                        <label for="status"
                            class="block mb-1 text-sm font-medium text-pastel-dark-600 dark:text-pastel-light-300">
                            Status
                        </label>
                        <div class="relative">
                            <Combobox v-model="filterStatus" @update:modelValue="handleFilter">
                                <div class="relative">
                                    <ComboboxInput
                                        class="w-full py-2 pl-4 pr-12 border rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-600 dark:border-pastel-dark-500 dark:text-pastel-light-300 focus:outline-none focus:border-pastel-dark-700"
                                        @change="query = $event.target.value"
                                        :displayValue="(status) => filterOptions.find(opt => opt.value === status)?.label || 'Semua'"
                                        placeholder="Pilih status..." />
                                    <ComboboxButton id="status"
                                        class="absolute inset-y-0 right-0 flex items-center px-2">
                                        <span class="text-gray-400 material-icons">expand_more</span>
                                    </ComboboxButton>
                                </div>
                                <ComboboxOptions
                                    class="absolute z-10 w-full mt-1 overflow-auto rounded-md shadow-lg bg-pastel-light-500 dark:bg-pastel-dark-600 max-h-60">
                                    <ComboboxOption v-for="option in filteredOptions" :key="option.id"
                                        :value="option.value" v-slot="{ selected, active }">
                                        <li
                                            :class="['cursor-default select-none relative py-2 pl-4 pr-4', active ? 'bg-pastel-red-600 text-white' : 'text-pastel-dark-600 dark:text-pastel-light-300']">
                                            {{ option.label }}
                                        </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                            </Combobox>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <data-table :columns="columns" :items="brands" :loading="loading" :error="error"
                                    empty-message="Tidak ada data brand">
                                    <template #row="{ item: brand }">
                                        <td class="td">
                                            <img :src="`https://vl.imgix.net/img/${formatBrandName(brand.name)}-logo.png`"
                                                class="flex-shrink-0 object-contain w-16 h-16 p-1 rounded-lg bg-pastel-light-100 dark:bg-pastel-dark-700" />
                                        </td>
                                        <td class="td">
                                            {{ brand.name }}
                                        </td>
                                        <td class="text-center td">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold cursor-default"
                                                :class="brand.deleted_at ? 'bg-pastel-red-300 text-pastel-red-800 dark:bg-pastel-red-900 dark:text-pastel-red-300' : 'bg-pastel-green-300 text-pastel-green-800 dark:bg-pastel-green-900 dark:text-pastel-green-300'">
                                                {{ brand.deleted_at ? "Tidak Aktif" : "Aktif" }}
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
                                                    <div v-show="activeMenu === brand.id"
                                                        class="absolute z-50 overflow-hidden border rounded-lg shadow-lg dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 -bottom-3 right-14 dark:bg-pastel-dark-800 w-36 menu-container"
                                                        @click.stop>
                                                        <router-link
                                                            :to="{ name: 'brand_edit', params: { id: brand.id } }"
                                                            class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700">
                                                            Ubah
                                                        </router-link>
                                                        <button
                                                            @click.stop="handleDelete(brand.id, brand.name, brand.deleted_at ? 0 : 1)"
                                                            :class="brand.deleted_at
                                                                ? 'block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-green-600 hover:bg-gray-100 dark:text-green-red-400 dark:hover:bg-pastel-dark-700'
                                                                : 'block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-red-600 hover:bg-gray-100 dark:text-pastel-red-400 dark:hover:bg-pastel-dark-700'
                                                                ">
                                                            {{ brand.deleted_at ? "Pulihkan" : "Hapus" }}
                                                        </button>
                                                    </div>
                                                </transition>
                                                <button @click.stop="toggleMenu(brand.id, $event)"
                                                    class="font-bold btn btn-sm btn-blue btn-rounded">
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
                    <div v-else-if="brands.length === 0"
                        class="p-4 text-center text-pastel-dark-600 dark:text-pastel-dark-300">
                        <span class="material-icons" style="font-size: 50px;">sentiment_dissatisfied</span>
                        <p class="mt-2">
                            Tidak ada data brand
                        </p>
                    </div>
                    <div v-else class="space-y-4">
                        <div v-for="brand in brands" :key="brand.id"
                            class="p-4 border rounded-lg shadow-sm dark:border-pastel-dark-500 bg-pastel-light-500 dark:bg-pastel-dark-700 hover:bg-pastel-light-700 dark:hover:bg-pastel-dark-800">
                            <div class="flex items-center justify-between p-1">
                                <div class="flex items-center flex-1 space-x-4">
                                    <div
                                        class="flex-shrink-0 w-16 h-16 p-2 rounded-lg shadow-sm bg-pastel-light-500 dark:bg-pastel-dark-700">
                                        <img :src="`https://vl.imgix.net/img/${formatBrandName(brand.name)}-logo.png`"
                                            class="object-contain w-20 h-16" :alt="brand.name" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="text-base font-semibold truncate text-pastel-dark-700 dark:text-pastel-light-200">
                                            {{ brand.name }}
                                        </h3>
                                        <div class="mt-1">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium cursor-default"
                                                :class="brand.deleted_at
                                                    ? 'bg-pastel-red-300 text-pastel-red-800 dark:bg-pastel-red-900 dark:text-pastel-red-300'
                                                    : 'bg-pastel-green-300 text-pastel-green-800 dark:bg-pastel-green-900 dark:text-pastel-green-300'">
                                                <span class="w-2 h-2 rounded-full mr-1.5"
                                                    :class="brand.deleted_at ? 'bg-pastel-red-800 dark:text-pastel-red-300' : 'bg-pastel-green-800 dark:text-pastel-green-300'"></span>
                                                {{ brand.deleted_at ? "Tidak Aktif" : "Aktif" }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative ml-4">
                                    <button @click.stop="toggleMenu(brand.id, $event)"
                                        class="flex items-center justify-center p-2 text-gray-600 transition-colors rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-pastel-dark-600">
                                        <span class="text-xl material-icons">more_vert</span>
                                    </button>
                                    <transition enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <div v-show="activeMenu === brand.id"
                                            class="absolute right-0 z-50 w-40 mt-2 overflow-hidden border rounded-lg shadow-lg dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 dark:bg-pastel-dark-800 menu-container">
                                            <router-link :to="{ name: 'brand_edit', params: { id: brand.id } }"
                                                class="flex items-center w-full px-4 py-2.5 font-medium text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700">
                                                <span class="mr-2 text-sm material-icons">edit</span>
                                                Ubah
                                            </router-link>
                                            <button
                                                @click.stop="handleDelete(brand.id, brand.name, brand.deleted_at ? 0 : 1)"
                                                :class="brand.deleted_at
                                                    ? 'flex items-center w-full px-4 py-2.5 font-medium text-left transition-colors text-pastel-green-600 hover:bg-gray-100 dark:text-green-400 dark:hover:bg-pastel-dark-700'
                                                    : 'flex items-center w-full px-4 py-2.5 font-medium text-left transition-colors text-pastel-red-600 hover:bg-gray-100 dark:text-pastel-red-400 dark:hover:bg-pastel-dark-700'">
                                                <span class="mr-2 text-sm material-icons">
                                                    {{ brand.deleted_at ? 'restore' : 'delete' }}
                                                </span>
                                                {{ brand.deleted_at ? "Pulihkan" : "Hapus" }}
                                            </button>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Pagination v-if="!loading && brands.length > 0" :current-page="pagination.current_page"
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
import { Combobox, ComboboxInput, ComboboxOptions, ComboboxButton, ComboboxOption } from "@headlessui/vue";
import { onMounted, ref, onUnmounted, computed } from "vue";
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
const filterStatus = ref("");
let searchTimeout = null;
const query = ref("");
const filterOptions = [
    { id: 0, value: 0, label: 'Semua' },
    { id: 1, value: 'active', label: 'Aktif' },
    { id: 2, value: 'inactive', label: 'Tidak Aktif' }
]
const filteredOptions = computed(() => {
    return filterOptions.filter((option) =>
        option.label.toLowerCase().includes(query.value.toLowerCase())
    )
})
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
        const response = await axios.get("/api/brands", {
            params: {
                search: search,
                paginate: true,
                dataTotal: dataTotal,
                status: filterStatus.value,
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
const handleFilter = () => {
    pagination.value.current_page = 1;
    fetchBrands(searchQuery.value, pagination.value.current_page);
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
const handleDelete = async (itemId, itemName, itemStatus) => {
    const result = await Swal.fire({
        title: `Konfirmasi ${itemStatus ? "Hapus" : "Pemulihan"} Data`,
        text: `Apakah Anda yakin ingin ${itemStatus ? "menghapus" : "memulihkan"} data brand ${itemName}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#EF4444",
        cancelButtonColor: "#6B7280",
        confirmButtonText: itemStatus ? "Ya, Hapus Data" : "Ya, Pulihkan Data",
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
            await axios.delete(`/api/brands/${itemId}`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });

            await Swal.fire({
                title: "Berhasil!",
                text: "Brand berhasil " + (itemStatus ? "dihapus" : "dipulihkan"),
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
                    `Terjadi kesalahan saat ${itemStatus ? "menghapus" : "memulihkan"} data.`,
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
