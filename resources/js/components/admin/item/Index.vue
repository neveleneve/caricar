<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">directions_car</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">
                            Data Kendaraan
                        </span>
                    </h1>
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
                        <label for="brand"
                            class="block mb-1 text-sm font-medium text-pastel-dark-600 dark:text-pastel-light-300">
                            Brand
                        </label>
                        <div class="relative">
                            <Combobox v-model="filterStatus" @update:modelValue="handleFilter">
                                <div class="relative">
                                    <ComboboxInput
                                        class="w-full py-2 pl-4 pr-12 border rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-600 dark:border-pastel-dark-500 dark:text-pastel-light-300 focus:outline-none focus:border-pastel-dark-700"
                                        @change="query = $event.target.value"
                                        :displayValue="(status) => filterOptions.find(opt => opt.value === status)?.label || 'Semua'"
                                        placeholder="Pilih status..." />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center px-2"
                                        id="brand">
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
                <!-- desktop table -->
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <data-table :columns="columns" :items="items" :loading="loading" :error="error">
                                    <template #row="{ item: items }">
                                        <td class="td">
                                            <div
                                                class="flex-shrink-0 w-16 h-16 rounded-lg bg-pastel-light-500 dark:bg-pastel-dark-700">
                                                <img :src="`https://vl.imgix.net/img/${formatBrandName(items.brand.name)}-logo.png`"
                                                    :alt="items.name" class="object-contain w-full h-full" />
                                            </div>
                                        </td>
                                        <td class="td">
                                            {{ items.brand.name }}
                                        </td>
                                        <td class="td">
                                            {{ items.name }}
                                        </td>
                                        <td class="td">
                                            {{ items.user.name }}
                                        </td>
                                        <td class="td">
                                            {{ items.condition == 'new' ? 'Baru' : 'Bekas' }}
                                        </td>
                                        <td class="text-right td">
                                            <div class="relative inline-flex items-center justify-end gap-2">
                                                <transition enter-active-class="transition duration-100 ease-out"
                                                    enter-from-class="transform scale-95 opacity-0"
                                                    enter-to-class="transform scale-100 opacity-100"
                                                    leave-active-class="transition duration-75 ease-in"
                                                    leave-from-class="transform scale-100 opacity-100"
                                                    leave-to-class="transform scale-95 opacity-0">
                                                    <div v-show="activeMenu === items.id"
                                                        class="absolute z-50 overflow-hidden border rounded-lg shadow-lg dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 -bottom-3 right-14 dark:bg-pastel-dark-800 w-36 menu-container"
                                                        @click.stop>
                                                        <router-link
                                                            :to="{ name: 'item_view', params: { id: items.id } }"
                                                            class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700">
                                                            Lihat
                                                        </router-link>
                                                    </div>
                                                </transition>
                                                <button @click.stop="toggleMenu(items.id, $event)"
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
                <!-- mobile table -->
                <div class="lg:hidden">
                    <div v-if="loading" class="flex justify-center p-4">
                        <div
                            class="w-6 h-6 border-2 border-t-2 rounded-full border-pastel-dark-300 border-t-pastel-dark-700 animate-spin">
                        </div>
                    </div>
                    <div v-else-if="error" class="p-4 text-center text-pastel-red-600 dark:text-pastel-red-400">
                        {{ error }}
                    </div>
                    <div v-else-if="items.length === 0"
                        class="p-4 text-center text-pastel-dark-600 dark:text-pastel-dark-300">
                        <span class="material-icons" style="font-size: 50px;">sentiment_dissatisfied</span>
                        <p class="mt-2">Tidak ada data item</p>
                    </div>
                    <div v-else class="space-y-4">
                        <div v-for="item in items" :key="item.id"
                            class="p-4 border rounded-lg shadow-sm dark:border-pastel-dark-500 bg-pastel-light-500 dark:bg-pastel-dark-700 hover:bg-pastel-light-600 dark:hover:bg-pastel-dark-800">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="flex-shrink-0 w-16 h-16 rounded-lg bg-pastel-light-500 dark:bg-pastel-dark-700">
                                    <img :src="`https://vl.imgix.net/img/${formatBrandName(item.brand.name)}-logo.png`"
                                        :alt="item.name" class="object-contain w-full h-full" />
                                </div>

                                <div class="flex items-center flex-1 space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="flex items-center gap-2 font-medium text-md text-pastel-dark-700 dark:text-pastel-light-200">
                                            {{ item.name }}
                                            <span :class="{
                                                'inline-flex items-center px-2.5 py-0.5 cursor-default rounded-full text-xs font-medium': true,
                                                'bg-pastel-green-100 text-pastel-green-800 dark:bg-pastel-green-900 dark:text-pastel-green-300': item.condition === 'new',
                                                'bg-pastel-yellow-100 text-pastel-yellow-800 dark:bg-pastel-yellow-900 dark:text-pastel-yellow-300': item.condition === 'used'
                                            }">
                                                {{ item.condition == 'new' ? 'Baru' : 'Bekas' }}
                                            </span>
                                        </p>
                                        <p class="text-xs font-medium text-pastel-dark-700 dark:text-pastel-light-200">
                                            {{ item.brand.name }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="text-xs text-pastel-dark-600 dark:text-pastel-dark-300">
                                                by
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 cursor-default rounded-full text-xs font-medium bg-pastel-blue-100 text-pastel-blue-800 dark:bg-pastel-blue-900 dark:text-pastel-blue-300">
                                                    {{ item.user.name }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="relative ml-4">
                                        <button @click.stop="toggleMenu(item.id, $event)"
                                            class="flex items-center justify-center p-2 text-gray-600 transition-colors rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-pastel-dark-600">
                                            <span class="text-xl material-icons">more_vert</span>
                                        </button>
                                        <transition enter-active-class="transition duration-100 ease-out"
                                            enter-from-class="transform scale-95 opacity-0"
                                            enter-to-class="transform scale-100 opacity-100"
                                            leave-active-class="transition duration-75 ease-in"
                                            leave-from-class="transform scale-100 opacity-100"
                                            leave-to-class="transform scale-95 opacity-0">
                                            <div v-show="activeMenu === item.id" @click.stop
                                                class="absolute right-0 z-50 overflow-hidden border rounded-lg shadow-lg top-10 dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 dark:bg-pastel-dark-800 w-36 menu-container">
                                                <router-link :to="{ name: 'item_view', params: { id: item.id } }"
                                                    class="block w-full px-4 py-3 font-bold text-left transition-colors text-pastel-dark-700 hover:bg-gray-100 dark:text-pastel-light-200 dark:hover:bg-pastel-dark-700">
                                                    Lihat
                                                </router-link>
                                            </div>
                                        </transition>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <Pagination v-if="!loading && items.length > 0" :current-page="pagination.current_page"
                    :last-page="pagination.last_page" :from="pagination.from" :to="pagination.to"
                    :total="pagination.total" @change-page="changePage" />
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup>
import DataTable from '@/components/layouts/DataTable.vue'
import Pagination from '@/components/layouts/Pagination.vue'
import DashboardLayout from '@/components/layouts/Sidebar.vue'
import { Combobox, ComboboxInput, ComboboxOptions, ComboboxButton, ComboboxOption } from "@headlessui/vue";
import { onUnmounted, onMounted, ref, computed } from 'vue'
import { storage } from '@/utils/storage'
import { STORAGE_KEYS } from '@/utils/constants'
import axios from 'axios'

const items = ref([])
const activeMenu = ref(null)
const activeItem = ref(null)
const loading = ref(true)
const error = ref(null)
const searchQuery = ref('')
const filterStatus = ref("");
let searchTimeout = null
const query = ref("");
const filterOptions = ref([
    { id: 0, value: null, label: 'Semua' }
])

const fetchBrands = async () => {
    try {
        const response = await axios.get('/api/brands', {
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        });
        const brands = response.data.data;
        if (Array.isArray(brands)) {
            filterOptions.value = [
                { id: 0, value: null, label: 'Semua' },
                ...brands.map(brand => ({
                    id: brand.id,
                    value: brand.id,
                    label: brand.name
                }))
            ];
        }
    } catch (err) {
        console.error('Error fetching brands:', err);
        error.value = 'Failed to load brands';
    }
};

const filteredOptions = computed(() => {
    return filterOptions.value.filter((option) =>
        option.label.toLowerCase().includes(query.value.toLowerCase())
    )
})
const pagination = ref({
    current_page: 1,
    last_page: 1,
    from: 0,
    to: 0,
    total: 0,
})

const columns = [
    { name: 'image', label: '' },
    { name: 'brand', label: 'Brand' },
    { name: 'name', label: 'Nama' },
    { name: 'seller', label: 'Penjual' },
    { name: 'condition', label: 'Kondisi' },
    { name: 'action', label: 'Aksi', align: 'right' },
]

const handleFilter = () => {
    pagination.value.current_page = 1;
    fetchItems(searchQuery.value, pagination.value.current_page);
};
const formatBrandName = (name) => {
    return name.toLowerCase().replace(/\s+/g, "-");
};

const fetchItems = async (search = "", page = 1, dataTotal = 10) => {
    loading.value = true
    error.value = null
    try {
        const params = {
            search: search,
            page: page,
            dataTotal: dataTotal,
        }

        if (filterStatus.value !== 0 && filterStatus.value !== "") {
            params.brand_id = filterStatus.value;
        }

        const response = await axios.get('/api/items', {
            params: params,
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        })
        items.value = response.data.data.data
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
        loading.value = false
    }
}

const handleSearch = () => {
    if (searchTimeout) {
        clearTimeout(searchTimeout)
    }
    searchTimeout = setTimeout(() => {
        fetchItems(searchQuery.value, pagination.value.current_page)
    }, 300)
}

const changePage = (page) => {
    if (page >= 1 && page <= pagination.value.last_page) {
        fetchItems(searchQuery.value, page);
    }
};

const toggleMenu = (itemId, event) => {
    event.stopPropagation();
    activeMenu.value = activeMenu.value === itemId ? null : itemId;
    activeItem.value = items.value.find((b) => b.id === itemId);
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
    fetchItems()
    fetchBrands()
    document.addEventListener("click", handleClickOutside);
})

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
})
</script>
