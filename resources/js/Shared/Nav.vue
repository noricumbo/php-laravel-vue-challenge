<template>
    <nav>
        <ul class=" flex space-x-6 list-inside">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'">
                    Home
                </NavLink>
            </li>
            <li>
                <NavLink href="/users" :active="$page.component === 'Users/Index'">
                    Users
                </NavLink>
            </li>
            <li>
                <NavLink href="/teams" :active="$page.component === 'Teams/Index'">
                    Teams
                </NavLink>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import NavLink from "./NavLink.vue"
</script>