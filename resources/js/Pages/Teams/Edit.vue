<template>
    <Head title="Edit User" />
    <h1 class="text-3xl mb-8">Edit team info <span class="text-sm">({{ userStore.team.id }})</span></h1>

    <div class="max-w-md mx-auto">
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-600" for="name">
                Name
            </label>
            <input v-model="teamNameInput" type="text" class="border border-gray-400 p-2 w-full" v-on:input="updateTeamName()" />
            <div v-if="!teamNameInput" v-text="`You need a name for your team`" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-600" for="color">
                Color <span class="text-gray-400">(hexadecimal value)</span>
            </label>
            <input v-model="teamColorInput" type="color" class="border border-gray-400 p-2 w-full h-80" v-on:input="updateTeamColor()" />
            <div v-if="!teamColorInput" v-text="`You need a color for your team`" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6 grid">
            <button v-if="teamNameInput && teamColorInput" class="justify-self-end text-gray-600 py-2 px-4 border border-gray-300 rounded bg-gray-100 hover:bg-gray-200" v-on:click="nextStep()">Next</button>
        </div>
    </div>
</template>
<script setup>
import Layout from "../../Shared/Layout.vue"
import { useUserStore } from "../../Stores/UserStore.js"
import {ref} from "vue";
import {router} from "@inertiajs/vue3";

const userStore = useUserStore();

if(!userStore.team.id) {
    router.get('/teams')
}

defineOptions({
    layout: Layout,
})

const props = defineProps({
    team: Object,
})

const teamNameInput = ref( userStore.team.name )
const teamColorInput = ref( userStore.team.color )

function updateTeamName() {
    userStore.team.name = teamNameInput
}

function updateTeamColor() {
    userStore.team.color = teamColorInput
}

function nextStep() {
    router.get('/teams-select-members')
}

</script>