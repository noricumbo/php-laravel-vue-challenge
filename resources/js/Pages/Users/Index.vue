<template>
    <Head title="Users" />

    <div class="flex justify-between mb-5">
        <div class="flex items-center">

            <h1 class="text-3xl">Users</h1>

            <p class="content-center">
                <Link :href="`/users/create`" class="text-blue-400 hover:text-blue-600 text-sm ml-3">New User</Link>
            </p>

        </div>

        <div class="flex justify-end">

            <p class="text-gray-400 text-sm mr-2 line-height-1 content-center">Select filter: </p>

            <select v-model="search_filter" class="border border-gray-300 px-2 rounded-lg text-gray-500 mr-2">
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="id">User ID</option>
            </select>

            <input v-model="search" type="text" placeholder="Search..." class="border border-gray-300 px-2 rounded-lg">
        </div>
    </div>


    <table class="table-auto w-full border-collapse border border-gray-400 bg-white text-sm dark:border-gray-500 dark:bg-gray-800">
        <caption class="caption-bottom">
            Users table
        </caption>
        <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('id')">
                User ID
                <span v-if="filters.column === 'id' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'id' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('name')">
                Name
                <span v-if="filters.column === 'name' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'name' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('email')">
                Email
                <span v-if="filters.column === 'email' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'email' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('created_at')">
                Creation date
                <span v-if="filters.column === 'created_at' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'created_at' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">
                Details
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users.data" :key="user.id">
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ user.id }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ user.name }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ user.email }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ user.created_at }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">
                <Link :href="`/users/${user.id}`" class="text-blue-400 hover:text-blue-600">
                    View
                </Link>
            </td>
        </tr>
        </tbody>
    </table>

    <Pagination :links="users.links" class="mt-6" />
</template>

<script setup>
import Layout from '../../Shared/Layout.vue'
import Pagination from "../../Shared/Pagination.vue"
import { ref, watch } from "vue"
import { router } from "@inertiajs/vue3"
import debounce from "lodash/debounce";

defineOptions({
    layout: Layout
})

defineProps({
    users: Object,
    filters: Object
})

let search = ref('')
let search_filter = ref('name')
let column = ref('')
let order = ref('asc')

watch(search, debounce( function () {
    let url = '/users'
    let data = {
        search: search.value
    }

    if( search_filter.value !== '') data.search_filter = search_filter.value

    router.get( url , data, {
        preserveState: true,
        replace: true
    })
}, 300 ))

function sort(column) {
    let url = '/users'
    order = order === 'asc' ? 'desc' : 'asc'

    let data = {
        column: column,
        order: order
    }

    if( search.value !== '' ) data.search = search.value
    if( search_filter.value !== '') data.search_filter = search_filter.value

    router.get(url, data, {
        preserveState: true,
        replace: true
    })
}
</script>