<template>
    <table class="table">
        <thead class="thead" v-if="items?.length > 0 && !loading && !error">
            <tr>
                <th v-for="column in columns" :key="column.key"
                    :class="[column.align ? 'text-' + column.align : 'text-left', 'th', column.class]">
                    {{ column.label }}
                </th>
            </tr>
        </thead>
        <tbody class="tbody">
            <tr v-if="loading" class="animate-pulse">
                <td :colspan="columns.length" class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center">
                        <span class="w-6 h-6 text-gray-400 material-icons animate-spin dark:text-gray-300">sync</span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">Loading data...</span>
                    </div>
                </td>
            </tr>
            <tr v-else-if="error" class="bg-pastel-red-400 dark:bg-pastel-red-800">
                <td :colspan="columns.length" class="px-6 py-4 text-sm text-center text-red-500 dark:text-red-400">
                    {{ error }}
                </td>
            </tr>
            <tr v-else-if="!items.length">
                <td :colspan="columns.length" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                    <span class="material-icons" style="font-size: 50px;">sentiment_dissatisfied</span>
                    <p class="mt-2">
                        {{ emptyMessage }}
                    </p>
                </td>
            </tr>
            <tr v-else v-for="item in items" :key="item.id" class="tr">
                <slot name="row" :item="item"></slot>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "DataTable",
    props: {
        columns: {
            type: Array,
            required: true,
        },
        items: {
            type: Object,
            default: () => [],
        },
        loading: {
            type: Boolean,
            default: false,
        },
        error: {
            type: String,
            default: null,
        },
        emptyMessage: {
            type: String,
            default: "Tidak ada data",
        },
    },
};
</script>
