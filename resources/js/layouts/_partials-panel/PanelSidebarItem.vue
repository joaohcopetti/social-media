<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'
import { Link } from '@inertiajs/vue3'

withDefaults(
    defineProps<{
        label: string
        active?: boolean
        url: string
        icon: string
    }>(),
    {
        active: false,
    },
)
</script>

<template>
    <li>
        <Link
            :href="url"
            class="group flex items-center rounded-lg p-2 text-gray-900 transition-colors hover:bg-gray-100 dark:text-white dark:hover:bg-slate-600"
            :class="{
                'bg-slate-700 font-bold': active,
            }"
        >
            <Icon
                :icon="icon"
                style="font-size: 1.2rem"
            />
            <span class="ms-3">{{ label }}</span>
        </Link>
    </li>
</template>
