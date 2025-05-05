import { defineStore } from 'pinia'

export const useUserStore = defineStore( 'userStore', {
    state: () => ({
        name: 'User from Pinia',
        users: [
            { name: "your name" }
        ],
        team: {
            id: null,
            name: null,
            color: null,
            membersList: []
        },
    })
})