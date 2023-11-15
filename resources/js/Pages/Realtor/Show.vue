<template>
    <div class="mb-4">
        <Link :href="`/realtor/listing`">← Go back to listings</Link>
    </div>
    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No Offers
            </div>
        </Box>
        <div v-else class="md:col-span-7">
            <offer class="mb-4" v-for="offer in props.listing.offers" :offer="offer" :listing-price="props.listing.price"/>
        </div>

        <Box class="col-span-5 h-fit">
            <template #header>
                Basic info
            </template>
            <Price :price="listing.price" class="text-2xl font-bold"/>
            <ListingSpace :listing="listing" class="text-lg"/>
            <ListingAddress :listing="listing" class="text-gray-500"/>
        </Box>
    </section>
</template>

<script setup>
    import {Link} from '@inertiajs/vue3';
    import Box from "@/Components/UI/Box.vue";
    import Price from "@/Components/Price.vue";
    import ListingSpace from "@/Components/ListingSpace.vue";
    import ListingAddress from "@/Components/listingAddress.vue";
    import {computed} from "vue";
    import Offer from "@/Pages/Realtor/Show/Components/Offer.vue";

    const props = defineProps({
        listing: Object
    })

    const hasOffers = computed(() =>{
        return props.listing.offers.length
    })
</script>
