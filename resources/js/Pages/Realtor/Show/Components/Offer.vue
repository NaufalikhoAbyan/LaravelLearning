<template>
    <Box>
        <template #header>Offer #{{props.offer.id}}</template>
        <div class="flex justify-between items-center">
            <div>
                <Price :price="props.offer.amount" class="text-xl"/>
                <div class="text-gray-500">Difference <Price :price="difference"/></div>
                <div class="text-gray-500 text-sm">Made by John Doe</div>
                <div class="text-gray-500 text-sm">Made on {{madeOn}}</div>
            </div>
            <div>
                <Link class="btn-outline text-xs font-medium" as="button">Accept</Link>
            </div>
        </div>
    </Box>
</template>

<script setup>
    import Box from "@/Components/UI/Box.vue";
    import Price from "@/Components/Price.vue";
    import {computed} from "vue";
    import {Link} from "@inertiajs/vue3";

    const props = defineProps({
        offer: Object,
        listingPrice: Number
    })

    const difference = computed(() => {
        return props.offer.amount - props.listingPrice
    })

    const madeOn = computed(() => {
        return new Date(props.offer.created_at).toLocaleDateString()
    })
</script>
