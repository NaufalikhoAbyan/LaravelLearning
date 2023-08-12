<template>
    <div>Show</div>
    <Link href="/">Index</Link>
    <div>
        The message is {{ message }}
    </div>
</template>

<script setup>
    import {Link} from '@inertiajs/vue3';
    defineProps([
        'message'
    ]);
</script>