<template>
    <Box>
        <form enctype="multipart/form-data" method="POST" :action="`/realtor/listing/${listing.id}/image`">
            <input type="file" multiple name="images[]">
            <button type="submit" class="btn-outline">send</button>
        </form>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";

const props = defineProps({
    listing: Object
})
</script>
