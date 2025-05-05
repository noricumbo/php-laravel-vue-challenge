<template>
    <div class="flex justify-center">
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="px-1 text-blue-400 hover:text-blue-600"
            :class="{ 'text-gray-400 hover:text-gray-400' : !link.url, 'font-bold text-gray-800' : link.active }"
        />
    </div>
</template>

<script setup>
defineProps({
    links: Array
})
</script>