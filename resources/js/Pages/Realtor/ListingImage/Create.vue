<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="form.post(`/realtor/listing/${listing.id}/image`, {onSuccess: () => form.reset('images')})" >
            <input type="file" multiple @input="addFiles">
            <button type="submit" class="btn-outline">send</button>
        </form>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    listing: Object
})

const form = useForm({
    images: []
})

const addFiles = (event) => {
    for(const image of event.target.files){
        form.images.push(image)
    }
}
</script>
