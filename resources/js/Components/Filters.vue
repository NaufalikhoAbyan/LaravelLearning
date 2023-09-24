<template>
    <form @submit.prevent="filter">
        <div class="flex mb-8 mt-4 gap-2 items-center">
            <div>
                <input v-model.number="filterForm.priceFrom" type="text" placeholder="price from" class="input-filter-l w-28">
                <input v-model.number="filterForm.priceTo" type="text" placeholder="price to" class="input-filter-r w-28">
            </div>
            <div>
                <select v-model="filterForm.beds" class="input-filter-l w-28">
                    <option :value="null">beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option value="">6+</option>
                </select>
                <select v-model="filterForm.baths" class="input-filter-r w-28">
                    <option :value="null">baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option value="">6+</option>
                </select>
            </div>
            <div>
                <input v-model.number="filterForm.areaFrom" type="text" placeholder="area from" class="input-filter-l w-28">
                <input v-model.number="filterForm.areaTo" type="text" placeholder="area to" class="input-filter-r w-28">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn-normal">Filter</button>
                <button type="reset" @click='clear' >Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    filters: Object
})

const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
})

const filter = () =>{
    filterForm.get('/listing',{
        preserveState: true,
        preserveScroll: true,
        only: ['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']
    })
}

const clear = () =>{
    filterForm.priceFrom = null
    filterForm.priceTo = null
    filterForm.beds = null
    filterForm.baths = null
    filterForm.areaFrom = null
    filterForm.areaTo = null
    filter()
}
</script>
