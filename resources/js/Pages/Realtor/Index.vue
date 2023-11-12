<template>
    <h1 class="text-3xl mb-4">Your Listings ({{listingCount}})</h1>
    <section>
        <RealtorFilters :filters="props.filters"/>
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed' : listing.deleted_at}">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-25' : listing.deleted_at}">
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="listing"/>
                    </div>
                    <ListingAddress :listing="listing" class="text-gray-500"/>
                </div>
                <div>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <Link class="btn-outline text-xs font-medium" :href="`/listing/${listing.id}`">Preview</Link>
                        <Link class="btn-outline text-xs font-medium" :href="`/realtor/listing/${listing.id}/edit`">Edit</Link>
                        <Link v-if="!listing.deleted_at" class="btn-outline text-xs font-medium" :href="`/realtor/listing/${listing.id}`" method="DELETE" as="button">Delete</Link>
                        <Link v-else class="btn-outline text-xs font-medium" :href="`/realtor/listing/${listing.id}/restore`" as="button" method="put">Restore</Link>
                    </div>
                    <div class="mt-2">
                        <Link class="btn-outline text-xs font-medium w-full block text-center" :href="`/realtor/listing/${listing.id}/image/create`">Images ({{listing.images_count}})</Link>
                    </div>
                    <div class="mt-2">
                        <Link class="btn-outline text-xs font-medium w-full block text-center" :href="`/realtor/listing/${listing.id}`">Offers ({{listing.offers_count}})</Link>
                    </div>
                </div>
            </div>
        </Box>
    </section>
    <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="listings.links"/>
    </div>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3";
    import Box from "@/Components/UI/Box.vue";
    import Price from "@/Components/Price.vue";
    import ListingSpace from "@/Components/ListingSpace.vue";
    import ListingAddress from "@/Components/listingAddress.vue";
    import RealtorFilters from "@/Pages/Realtor/Index/Components/RealtorFilters.vue";
    import Pagination from "@/Components/UI/Pagination.vue";

    const props = defineProps({
        listings: Object,
        filters: Object,
        listingCount: Number,
    })
</script>
