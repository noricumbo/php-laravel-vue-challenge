<template>
    <Head title="Teams" />
    <div class="flex justify-between mb-5">
        <h1 class="text-3xl">Teams</h1>
    </div>

    <table class="table-auto w-full border-collapse border border-gray-400 bg-white text-sm dark:border-gray-500 dark:bg-gray-800">
        <caption class="caption-bottom">
            Teams table
        </caption>
        <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('id')">
                Team ID
                <span v-if="filters.column === 'id' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'id' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('name')">
                Name
                <span v-if="filters.column === 'name' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'name' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('email')">
                Slug
                <span v-if="filters.column === 'email' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'email' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200 cursor-pointer" v-on:click="sort('created_at')">
                Color
                <span v-if="filters.column === 'created_at' && filters.order === 'asc'">&#x25BC;</span>
                <span v-if="filters.column === 'created_at' && filters.order === 'desc'">&#x25B2;</span>
            </th>
            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">
                Details
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="team in teams.data" :key="team.id">
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ team.id }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ team.name }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ team.slug }}</td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400 w-35">
                <div class="w-8 h-8 float-left rounded" :style="`background-color: ${team.color}`"></div>
                <p class="ml-3 mt-1 float-left w-auto">{{ team.color }}</p>
            </td>
            <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">
                <Link :href="`/teams/${team.id}`" class="text-blue-400 hover:text-blue-600">
                    View
                </Link>
            </td>
        </tr>
        </tbody>
    </table>

    <Pagination :links="teams.links" class="mt-6" />
</template>
<script setup>
import Layout from '../../Shared/Layout.vue'
import Pagination from "../../Shared/Pagination.vue";

defineOptions({
    layout: Layout
})

defineProps({
    teams: Object,
    filters: Object
})

function sort() {

}
</script>