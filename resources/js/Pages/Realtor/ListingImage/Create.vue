<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="form.post(`/realtor/listing/${listing.id}/image`, {onSuccess: () => form.reset('images')})" >
            <section class="flex items-center gap-2 my-4">
                <input type="file" multiple @input="addFiles" class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4">
                <button type="submit" class="btn-outline" :disabled="!canUpload">Send</button>
                <button class="btn-outline" @click="form.reset">Reset</button>
            </section>
        </form>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    listing: Object
})

const form = useForm({
    images: []
})

const canUpload = computed(() => { return form.images.length > 0 });

const addFiles = (event) => {
    for(const image of event.target.files){
        form.images.push(image)
    }
}
</script>
