<template>
    <form @submit.prevent="form.post('/register')">
        <div class="w-1/2 mx-auto">
            <div>
                <label class="label" for="name">Your Name</label>
                <input type="text" class="input" name="name" id="name" v-model="form.name"/>
                <div class="input-error" v-if="form.errors.name">{{ form.errors.name }}</div>
            </div>
            <div class="mt-4">
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
                <label class="label" for="password_confirmation">Confirm password</label>
                <input type="password" class="input" name="password_confirmation" id="password_confirmation" v-model="form.password_confirmation"/>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">Create Account</button>
            </div>
            <div class="mt-2 text-center">
                <Link href="/login" class="text-sm text-gray-500">Already have an account? Click here</Link>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
</script>