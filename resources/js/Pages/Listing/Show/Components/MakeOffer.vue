<template>
    <Box class="mt-2">
        <template #header>Make an Offer</template>
        <form @submit.prevent="makeOffer">
            <input v-model.number="form.amount" type="text" class="input mt-2">
            <input v-model.number="form.amount" type="range" :min="min" :max="max" step="1000" class=" mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-200">
            <button class="mt-2 btn-outline w-full">Make an Offer</button>
            {{form.errors.amount}}
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
    amount: props.price
})

const difference = computed(() => {
    return props.price - form.amount;
});

const max = computed(() =>{
    return Math.round(props.price * 2);
})

const min = computed(() =>{
    return Math.round(props.price / 2);
})

const makeOffer = () => {
    form.post(`/listing/${props.listingId}/offer`,{
        preserveScroll: true,
        preserveState: true,
    })
}
</script>
