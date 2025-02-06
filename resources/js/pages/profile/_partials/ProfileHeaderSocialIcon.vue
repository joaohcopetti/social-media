<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'

defineProps<{
    href: string
    icon: InstanceType<typeof Icon>['$props']
}>()
</script>

<template>
    <a
        target="_blank"
        :href="href"
        class="transition-all hover:scale-105"
    >
        <Icon
            v-bind="icon"
            class="size-8 rounded-full bg-gray-200 p-1.5 text-slate-700 shadow-md hover:bg-gray-100"
        />
    </a>
</template>
