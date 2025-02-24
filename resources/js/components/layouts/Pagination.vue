<template>
    <div v-if="lastPage > 1" class="pagination">
        <div class="pagination-summary">
            <div class="pagination-info">
                <p class="pagination-info-text">
                    Showing
                    <span class="pagination-info-subtext">{{ from }}</span>
                    to
                    <span class="pagination-info-subtext">{{ to }}</span>
                    of
                    <span class="pagination-info-subtext">{{ total }}</span>
                    results
                </p>
            </div>
            <div class="pagination-section">
                <nav class="pagination-nav" aria-label="Pagination">
                    <button @click="$emit('change-page', 1)" :disabled="currentPage === 1" class="pagination-first"
                        :class="{ 'disabled': currentPage === 1 }">
                        <span class="text-sm material-icons">first_page</span>
                    </button>
                    <button @click="$emit('change-page', currentPage - 1)" :disabled="currentPage === 1"
                        class="pagination-prev" :class="{ 'disabled': currentPage === 1 }">
                        <span class="text-sm material-icons">chevron_left</span>
                    </button>

                    <button v-for="page in paginationRange" :key="page" @click="$emit('change-page', page)"
                        :class="[page === currentPage ? 'active' : 'inactive', 'pagination-item']">
                        {{ page }}
                    </button>

                    <button @click="$emit('change-page', currentPage + 1)" :disabled="currentPage === lastPage"
                        class="pagination-next" :class="{ 'disabled': currentPage === lastPage }">
                        <span class="text-sm material-icons">chevron_right</span>
                    </button>
                    <button @click="$emit('change-page', lastPage)" :disabled="currentPage === lastPage"
                        class="pagination-last" :class="{ 'disabled': currentPage === lastPage }">
                        <span class="text-sm material-icons">last_page</span>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { computed } from 'vue';

export default {
    name: 'Pagination',
    props: {
        currentPage: {
            type: Number,
            required: true
        },
        lastPage: {
            type: Number,
            required: true
        },
        from: {
            type: Number,
            required: true
        },
        to: {
            type: Number,
            required: true
        },
        total: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const paginationRange = computed(() => {
            const range = []
            const maxPages = 5
            let start = Math.max(1, props.currentPage - 2)
            let end = Math.min(props.lastPage, start + maxPages - 1)

            if (end - start + 1 < maxPages) {
                start = Math.max(1, end - maxPages + 1)
            }

            for (let i = start; i <= end; i++) {
                range.push(i)
            }
            return range
        })

        return {
            paginationRange
        }
    },
    emits: ['change-page']
}
</script>
