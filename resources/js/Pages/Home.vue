<template>
    <Head title="Home" />
    <h1 class="text-3xl mb-5">
        Hello!
    </h1>

    <p class="mb-5">Here you can see and update a <Link :href="`/users`" class="text-blue-400">list of people (users)</Link>. You can:</p>

    <ul class="list-disc list-inside">
        <li>Create new users</li>
        <li>Modify them</li>
        <li>Delete them</li>
        <li>View Teams</li>
        <li>Edit Teams details</li>
        <li>Add users (members) to a Team</li>
    </ul>

</template>

<script setup>
import Layout from '../Shared/Layout.vue'

defineOptions({
    layout: Layout
})
</script>