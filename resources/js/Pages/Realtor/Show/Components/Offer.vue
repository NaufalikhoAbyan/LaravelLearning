<template>
    <Box>
        <template #header>Offer #{{props.offer.id}} <span v-if="props.offer.accepted_at" class="bg-green-200 text-green-900 dark:bg-green-900 dark:text-green-200 p-1 rounded-md ml-1 uppercase">Accepted</span></template>
        <div class="flex justify-between items-center">
            <div>
                <Price :price="props.offer.amount" class="text-xl"/>
                <div class="text-gray-500">Difference <Price :price="difference"/></div>
                <div class="text-gray-500 text-sm">Made by {{props.offer.user.name}}</div>
                <div class="text-gray-500 text-sm">Made on {{madeOn}}</div>
            </div>
            <div v-if="notSold">
                <Link :href="`/realtor/offer/${props.offer.id}/accept`" class="btn-outline text-xs font-medium" as="button" method="PUT">Accept</Link>
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

    const notSold = computed(() => {
        return !props.offer.accepted_at && !props.offer.rejected_at
    })
</script>
