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
          <div v-if="$page.props.login" class="flex items-center gap-4">
            <div class="text-sm text-gray-400">{{ $page.props.login.name }}</div>
            <Link href="/listing/create" class="btn-primary">+ New listing</Link>
            <Link href="/logout" method="DELETE" as="button">Logout</Link>
          </div>
          <div v-else class="flex items-center gap-4">
            <Link href="/register">Register</Link>
            <Link href="/login">Sign-In</Link>
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