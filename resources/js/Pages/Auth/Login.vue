<template>
    <form @submit.prevent="form.post('/login')">
        <div class="w-1/2 mx-auto">
            <div>
                <label class="label" for="email">Email</label>
                <input type="text" class="input" name="email" id="email" v-model="form.email"/>
                <div class="input-error">Potential errors</div>
            </div>
            <div class="mt-4">
                <label class="label" for="password">Password</label>
                <input type="password" class="input" name="password" id="password" v-model="form.password"/>
                <div class="input-error">Potential errors</div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">Login</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
});
</script>