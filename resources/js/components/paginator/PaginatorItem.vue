<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

withDefaults(
    defineProps<{
        label?: string
        active?: boolean
        href?: string
    }>(),
    {
        label: undefined,
        active: false,
        href: undefined,
    },
)
</script>

<template>
    <Component
        :is="href ? Link : 'button'"
        :href="href"
        :class="[
            'flex h-10 items-center justify-center border px-4 leading-tight transition-colors',
            'border-slate-300 bg-white',
            'hover:bg-slate-100 hover:text-slate-700',
            'dark:border-slate-700 dark:bg-slate-800',
            'disabled:text-slate-500 dark:hover:bg-slate-700 dark:hover:text-white',
            {
                'font-bold dark:bg-slate-600': active,
                'text-slate-500 dark:text-slate-300': !active,
                'text pointer-events-none cursor-default': !href,
            },
        ]"
        :disabled="!href"
    >
        <template v-if="$slots['label']">
            <slot name="label" />
        </template>
        <template v-else>{{ label }}</template>
    </Component>
</template>
