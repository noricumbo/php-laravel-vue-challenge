<template>
    <Head title="Edit User" />
    <h1 class="text-3xl mb-8">Edit user info</h1>

    <form @submit.prevent="form.put('/users/' + user.data.id)" class="max-w-md mx-auto">
        <input v-model="form.id" type="hidden" name="user_id" id="user_id">
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
            <button type="submit" class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-600 cursor-pointer" :disabled="form.processing">Submit</button>
        </div>
    </form>
</template>
<script setup>
import Layout from "../../Shared/Layout.vue"
import { useForm } from "@inertiajs/vue3"

defineOptions({
    layout: Layout,
})

const props = defineProps({
    user: Object,
})

let form = useForm(props.user.data)

</script>