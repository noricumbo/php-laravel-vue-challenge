<template>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">
                    <Link :href="`/`">
                        Organize Teams
                    </Link>
                </h1>

                <p class="text-sm ml-6">
                    Hi, {{ userStore.name }}!
                </p>
            </div>

            <Nav/>
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-9/10 mx-auto">
            <slot/>
        </div>
    </section>
</template>

<script setup>
import Nav from "./Nav.vue"
import { useUserStore } from "../Stores/UserStore.js"

const userStore = useUserStore();

/** Here you can uncomment a Prompt that asks for your name and store it with Pinia **/

// const currentName = prompt("Hi, what's your name?")
// userStore.name = currentName

</script>