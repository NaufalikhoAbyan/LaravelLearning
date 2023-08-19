<template>
    <Link href="/">Main Page</Link>&nbsp;
    <Link href="/hello">Show Page</Link>
    <!-- <div>THe page with time {{ timer }}</div> -->
    <div v-if="$page.props.flash.success" class="success">
        {{ $page.props.flash.success }}
    </div>
    <slot></slot>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    // import { ref } from 'vue';

    // const timer = ref(0);
    // setInterval(() => timer.value++, 1000)
</script>

<style scoped>
  .success {
    background-color: green;
    color: white;
  }
</style>