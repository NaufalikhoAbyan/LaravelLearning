<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="form.post(`/realtor/listing/${listing.id}/image`, {onSuccess: () => form.reset('images')})" >
            <section class="flex items-center gap-2 my-4">
                <input type="file" multiple @input="addFiles" class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4">
                <button type="submit" class="btn-outline" :disabled="!canUpload">Send</button>
                <button class="btn-outline" @click="form.reset('images')">Reset</button>
            </section>
            <div v-if="imageErrors.length" class="input-error">
                <div v-for="(error, index) in imageErrors" :key="index">
                    {{ error }}
                </div>
            </div>
        </form>
    </Box>
    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Current Listing Images</template>
        <section class="grid grid-cols-3 mt-4 gap-4">
            <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
                <img :src="image.src" alt="" class="rounded-md">
                <Link :href="`/realtor/listing/${listing.id}/image/${image.id}`" method="DELETE" as="button" class="mt-2 btn-outline text-xs">Delete</Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import {useForm, Link} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    listing: Object
})

const form = useForm({
    images: []
})

const imageErrors = computed(() => {
    return Object.values(form.errors)
})

const canUpload = computed(() => { return form.images.length > 0 });

const addFiles = (event) => {
    for(const image of event.target.files){
        form.images.push(image)
    }
}
</script>
