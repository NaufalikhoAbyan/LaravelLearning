<template>
    <form @submit.prevent="form.post('/login')">
        <div class="w-1/2 mx-auto">
            <div>
                <label class="label" for="email">Email</label>
                <input type="text" class="input" name="email" id="email" v-model="form.email"/>
                <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label class="label" for="password">Password</label>
                <input type="password" class="input" name="password" id="password" v-model="form.password"/>
                <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">Login</button>
            </div>
            <div class="mt-2 text-center">
                <Link href="/register" class="text-sm text-gray-500">Need an account? Click here</Link>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
});
</script>