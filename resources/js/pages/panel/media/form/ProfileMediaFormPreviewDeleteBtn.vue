<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'
</script>

<template>
    <button
        class="absolute right-0 top-0 flex size-8 items-center justify-center rounded-bl-lg bg-red-500 shadow transition-opacity hover:bg-red-600 hover:opacity-100"
    >
        <Icon
            icon="ph:trash-fill"
            class="text-lg"
        />
    </button>
</template>
