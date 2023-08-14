<template>
    <div>
        <ListingAddress :listing="listing"/>
    </div>
</template>

<script setup>
    import ListingAddress from '../../Components/listingAddress.vue';

    defineProps([
        'listing'
    ])
</script>