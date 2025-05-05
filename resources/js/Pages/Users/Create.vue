<template>
    <Head title="Create User" />

    <h1 class="text-3xl mb-8">Create New User</h1>

    <form @submit.prevent="submit" class="max-w-md mx-auto">
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-600" for="name">
                Name
            </label>
            <input v-model="form.name" type="text" class="border border-gray-400 p-2 w-full" name="name" id="name" required />
            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-600" for="email">
                Email
            </label>
            <input v-model="form.email" type="email" class="border border-gray-400 p-2 w-full" name="email" id="email" required />
            <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-600" for="password">
                Password
            </label>
            <input v-model="form.password" type="password" class="border border-gray-400 p-2 w-full" name="password" id="password" required />
            <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-400" :disabled="form.processing">Submit</button>
        </div>
    </form>
</template>
<script setup>
import Layout from "../../Shared/Layout.vue"
import { useForm } from "@inertiajs/vue3"

defineOptions({
    layout: Layout
})

let form = useForm({
    name: '',
    email: '',
    password: '',
})

let submit = () => {
    form.post('/users')
}
</script>