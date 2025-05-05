<template>
    <Head title="Show Team" />
    <h1 class="text-3xl mb-8">Team info</h1>

    <ul class="max-w-8/10 mx-auto text-gray-800">
        <li class="mb-2"><b>Team ID:</b> {{ team.data.id }}</li>
        <li class="mb-2"><b>Name:</b> {{ team.data.name }}</li>
        <li class="mb-8"><b>Color:</b> {{ team.data.color }}
            <span :style="`background-color: ${team.data.color}`" class="w-6 h-6 inline-block ml-3 rounded"></span>
        </li>
        <li class="mb-12">
            <b>Team Members:</b>
            <p v-if="!members.length">No team members yet</p>
            <ol class="list-decimal list-inside">
                <li v-for="member in members">{{ member.name }}</li>
            </ol>
        </li>
        <li class="flex justify-between">
            <Link :href="`/teams/${team.data.id}/edit`" class="text-gray-600 py-2 px-4 border border-gray-300 rounded bg-gray-100 hover:bg-gray-200" v-on:click="editTeamInfo(team.data.id, team.data.name, team.data.color)">
                Edit
            </Link>

            <form @submit.prevent="form.delete('/teams/' + team.data.id)">
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
import { useUserStore } from "../../Stores/UserStore.js"

const userStore = useUserStore();

defineOptions({
    layout: Layout,
})

const props = defineProps({
    team: Object,
    members: Object
})

let form = useForm(props.team.data)

function editTeamInfo(id, name, color) {
    userStore.team.id = id
    userStore.team.name = name
    userStore.team.color = color
    userStore.team.membersList = props.members
}

</script>