<template>
    <Box class="mt-2">
        <template #header>Make an Offer</template>
        <form>
            <input v-model.number="form.price" type="text" class="input mt-2">
            <input v-model.number="form.price" type="range" :min="props.price/2" :max="props.price*2" step="1000" class=" mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-200">
            <button class="mt-2 btn-outline w-full">Make an Offer</button>
        </form>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div><Price :price="difference"/></div>
        </div>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    listingId: Number,
    price: Number
})

const form = useForm({
    price: props.price
})

const difference = computed(() => {
    return props.price - form.price;
});
</script>
