<template>
    <div class="my-4 flex flex-wrap gap-2">
        <div class="flex flex-nowarp items-center gap-2">
            <input v-model="filterForm.deleted" type="checkbox" id="deleted" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <label for="deleted">Deleted</label>
        </div>
        <div class="flex flex-nowarp items-center">
            <select v-model="filterForm.by" class="input-filter-l">
                <option value="created_at">Added</option>
                <option value="price">Price</option>
            </select>
            <select v-model="filterForm.order" class="input-filter-r">
                <option v-for="option in sortOptions" :key="option.value" :value="option.value">{{option.label}}</option>
            </select>
        </div>
    </div>
</template>

<script setup>
    import { computed, reactive, watch } from "vue";
    import { router } from "@inertiajs/vue3";
    import { debounce } from "lodash";

    const props = defineProps({
        filters: Object,
    });

    const sortLabels = {
        created_at: [
            {
                label: 'Latest',
                value: 'desc',
            },
            {
                label: 'Oldest',
                value: 'asc',
            },
        ],
        price: [
            {
                label: 'Pricey',
                value: 'desc',
            },
            {
                label: 'Cheapest',
                value: 'asc',
            },
        ],
    };

    const sortOptions = computed(() => sortLabels[filterForm.by]);

    const filterForm = reactive({
        deleted: props.filters.deleted ?? false,
        by: props.filters.by ?? 'created_at',
        order: props.filters.order ?? 'desc',
    });
    watch(filterForm, debounce(() => router.get('/realtor/listing', filterForm, {
        preserveState: true,
        preserveScroll: true,
    }), 1000))
</script>
