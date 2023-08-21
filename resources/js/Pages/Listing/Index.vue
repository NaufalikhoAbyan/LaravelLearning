<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="listing in listings">
            <div>
                <Link :href="`/listing/${listing.id}`">
                    <Price :price="listing.price" class="text-2xl font-bold"/>
                    <ListingSpace :listing="listing" class="text-lg"/>
                    <ListingAddress :listing="listing" class="text-gray-500"/>
                </Link>
            </div>
            <div>
                <Link :href="`/listing/${listing.id}/edit`">Edit</Link>
                <Link :href="`/listing/${listing.id}`" method="DELETE" as="button">Delete</Link>
            </div>
        </Box>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import ListingAddress from '../../Components/listingAddress.vue';
    import Box from '../../Components/UI/Box.vue';
    import ListingSpace from '../../Components/ListingSpace.vue';
    import Price from '../../Components/Price.vue';
    defineProps([
        'listings'
    ])
</script>