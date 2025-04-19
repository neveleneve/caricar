<template>
    <dashboard-layout>
        <div class="mx-auto mb-4">
            <header class="page-header">
                <div class="flex items-center gap-3">
                    <h1
                        class="flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500">
                        <span class="material-icons">inventory</span>
                        <span class="ml-1 text-pastel-dark-700 dark:text-pastel-light-500">
                            Item
                        </span>
                    </h1>
                </div>
            </header>
        </div>
        <div class="pb-3 mx-auto rounded-lg">
            <div class="p-4 rounded-lg bg-pastel-light-100 dark:bg-pastel-dark-700">
                <div class="flex mb-6">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="w-5 h-5 text-gray-400 material-icons">search</span>
                        </span>
                        <input type="text" v-model="searchQuery" @input="handleSearch" placeholder="Cari item..."
                            class="search-input-full" id="pencarian" name="pencarian" />
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <data-table :columns="columns" :items="items" :loading="loading" :error="error">
                                    <template #row="{ item: items }">
                                        <td class="td">
                                            -
                                        </td>
                                        <td class="td">
                                            {{ items.name }}
                                        </td>
                                        <td class="td">
                                            {{ items.brand.name }}
                                        </td>
                                        <td class="td">
                                            {{ items.user.name }}
                                        </td>
                                        <td class="td">
                                            {{ items.condition == 'new' ? 'Baru' : 'Bekas' }}
                                        </td>
                                        <td class="td">
                                            {{ new Date(items.created_at).toLocaleDateString('id-ID', {
                                                weekday: 'long',
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            }) }}
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
                                                        items.id
                                                        "
                                                        class="absolute z-50 overflow-hidden border rounded-lg shadow-lg dark:border-pastel-dark-500 border-pastel-dark-300 bg-pastel-light-200 -bottom-3 right-14 dark:bg-pastel-dark-800 w-36 menu-container"
                                                        @click.stop>
                                                        <router-link
                                                            :to="{ name: 'user_view', params: { id: items.id } }"
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
import { onUnmounted, onMounted, ref } from 'vue'
import { storage } from '@/utils/storage'
import { STORAGE_KEYS } from '@/utils/constants'
import axios from 'axios'

const items = ref([])
const activeMenu = ref(null)
const activeItem = ref(null)
const loading = ref(true)
const error = ref(null)
const searchQuery = ref('')
let searchTimeout = null
const pagination = ref({
    current_page: 1,
    last_page: 1,
    from: 0,
    to: 0,
    total: 0,
})

const columns = [
    { name: 'image', label: '' },
    { name: 'name', label: 'Nama' },
    { name: 'brand', label: 'Brand' },
    { name: 'seller', label: 'Penjual' },
    { name: 'condition', label: 'Kondisi' },
    { name: 'created_at', label: 'Tanggal Pos' },
    { name: 'action', label: 'Aksi', align: 'right' },
]

const fetchItems = async (search = "", page = 1, dataTotal = 10) => {
    loading.value = true
    error.value = null
    try {
        const response = await axios.get('/api/items', {
            params: {
                search: search,
                page: page,
                dataTotal: dataTotal
            },
            headers: {
                Authorization: `Bearer ${storage.getItem(STORAGE_KEYS.TOKEN)}`,
            },
        })
        items.value = response.data.data.data
        console.log(response.data.data);
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
    document.addEventListener("click", handleClickOutside);
})

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
})
</script>
