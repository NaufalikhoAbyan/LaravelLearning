<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
      <div class="container mx-auto">
        <nav class="p-4 flex items-center justify-between">
          <div>
            <Link href="/listing">Listings</Link>
          </div>
          <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
            <Link href="/listing">LaraZillow</Link>
          </div>
          <div>
            <Link href="/listing/create" class="btn-primary">+ New listing</Link>
          </div>
        </nav>
      </div>
    </header>

    <main class="container mx-auto p-4">
      <div v-if="$page.props.flash.success" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2 text-center">
        {{ $page.props.flash.success }}
      </div>
      <slot></slot>
    </main>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
</script>