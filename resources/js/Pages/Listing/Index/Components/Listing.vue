<template>
    <Box>
        <div>
            <Link :href="`/listing/${listing.id}`">
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold"/>
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment"/>pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500"/>
            </Link>
        </div>
        <div>
            <Link :href="`/listing/${listing.id}/edit`">Edit</Link>&nbsp;
            <Link :href="`/listing/${listing.id}`" method="DELETE" as="button">Delete</Link>
        </div>
    </Box>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { computed } from 'vue';
    import ListingAddress from '@/Components/listingAddress.vue';
    import Box from '@/Components/UI/Box.vue';
    import ListingSpace from '@/Components/ListingSpace.vue';
    import Price from '@/Components/Price.vue';

    import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';

    const props = defineProps({
        listing: Object
    })

    const monthlyPayment = computed(() => useMonthlyPayment(props.listing.price, 2.5, 25))
    
</script>