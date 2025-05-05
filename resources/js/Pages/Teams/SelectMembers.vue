<template>
    <Head title="Edit User" />
    <h1 class="text-3xl mb-8">Add a Team Member <span class="text-sm">({{ userStore.team.id }})</span></h1>

    <div class="max-w-8/10 mx-auto">
        <input v-model="selectMembersInput" type="text" placeholder="Name of team member..." class="border border-gray-300 px-2 rounded-lg h-14 mb-8 w-full" />

        <h2 class="text-2xl mb-8">Select them</h2>

        <div v-if="members.length" class="mb-8 bg-gray-100 p-3 rounded-lg">
            <div v-for="member in members" :key="member.id" class="border border-gray-300 bg-white w-full rounded-lg px-2 py-4 hover:bg-gray-200 cursor-pointer" v-on:click="addMember(member)">
                <p class="">{{ member.name }} <span class="float-right text-sm text-gray-400">Click to add</span></p>
            </div>
        </div>

        <div class="grid">
            <h2 class="text-2xl mb-8">Members List</h2>
            <ol v-if="selectedMembersList.length" class="list-decimal list-inside mb-8 bg-gray-100 p-3 rounded-lg">
                <li v-for="(member, index) in selectedMembersList" :key="member.id" v-on:click="removeMember(member.id, index)" class="cursor-pointer border border-gray-300 bg-white w-full rounded-lg px-2 py-4 hover:bg-gray-200">
                    {{ member.name }}
                    <span class="float-right text-sm text-gray-400">Click to remove</span>
                </li>
            </ol>

            <button class="justify-self-end border border-gray-300 text-gray-500 rounded-lg px-4 py-2 hover:bg-gray-100 cursor-pointer" v-on:click="saveTeam()">Save Team</button>
        </div>
    </div>
</template>
<script setup>
import Layout from "../../Shared/Layout.vue"
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import {router} from "@inertiajs/vue3";
import { useUserStore } from "../../Stores/UserStore.js"

const userStore = useUserStore();

if(!userStore.team.id) {
    router.get('/teams')
}

defineOptions({
    layout: Layout,
})

const props = defineProps({
    members: Object,
})

const selectMembersInput = ref('')

watch(selectMembersInput, debounce( function() {
    router.get('/teams-select-members', {
        search: selectMembersInput.value
    }, {
        preserveState: true,
        replace: true
    })

}, 300 ))

const selectedMembersList = ref(userStore.team.membersList)

function addMember(member) {

    userStore.team.membersList.push({
        id: member.id,
        name: member.name
    })

    removeMemberFromOptions( member.id )

}
function removeMember(id, index) {
    console.log(id, index)
    selectedMembersList.value.splice(index, 1)
}

function removeMemberFromOptions(member) {
    let index = props.members.indexOf( props.members.find(({id}) => id === member) )
    props.members.splice(index, 1)
}

function saveTeam() {
    console.log(selectedMembersList.value)

    router.post('/teams-save-members', {
        team_id: userStore.team.id,
        team_name: userStore.team.name,
        team_color: userStore.team.color,
        team_members: selectedMembersList.value
    })
}

</script>