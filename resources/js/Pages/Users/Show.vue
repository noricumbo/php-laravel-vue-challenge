<template>
    <Head title="Show User" />
    <h1 class="text-3xl mb-8">User info</h1>

    <ul class="max-w-8/10 mx-auto text-gray-800">
        <li class="mb-2"><b>User ID:</b> {{ user.data.id }}</li>
        <li class="mb-2"><b>Name:</b> {{ user.data.name }}</li>
        <li class="mb-2"><b>Email:</b> {{ user.data.email }}</li>
        <li class="mb-2"><b>Email verified at:</b> {{ user.data.email_verified_at }}</li>
        <li class="mb-2"><b>Created at:</b> {{ user.data.created_at }}</li>
        <li class="mb-8"><b>Updated at:</b> {{ user.data.updated_at }}</li>
        <li class="flex justify-between">
            <Link :href="`/users/${user.data.id}/edit`" class="text-gray-500 py-2 px-4 border border-gray-300 rounded bg-gray-100 hover:bg-gray-200 hover:text-gray-600">
                Edit
            </Link>

            <form @submit.prevent="form.delete('/users/' + user.data.id)">
                <button type="submit" class="bg-red-400 text-white rounded py-2 px-4 hover:bg-red-600 cursor-pointer" :disabled="form.processing">
                    Delete
                </button>
            </form>
        </li>
    </ul>
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