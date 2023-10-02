<template>
    <div class="my-4 flex flex-wrap gap-2">
        <div class="flex flex-nowarp items-center gap-2">
            <input v-model="filterForm.deleted" type="checkbox" id="deleted" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <label for="deleted">Deleted</label>
        </div>
    </div>
</template>

<script setup>
    import { reactive } from "vue";
    import { watch } from "vue";
    import { router } from "@inertiajs/vue3";
    import { debounce } from "lodash";

    const filterForm = reactive({
        deleted: false,
    });
    watch(filterForm, debounce(() => router.get('/realtor/listing', filterForm, {
        preserveState: true,
        preserveScroll: true,
    }), 1000))
</script>
