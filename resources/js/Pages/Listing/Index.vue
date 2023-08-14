<template>
    <div v-for="listing in listings">
        <Link :href="`/listing/${listing.id}`"><ListingAddress :listing="listing"/></Link>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import ListingAddress from '../../Components/listingAddress.vue';
    defineProps([
        'listings'
    ])
</script>