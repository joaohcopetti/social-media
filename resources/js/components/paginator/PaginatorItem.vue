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
            'border-slate-700',
            'hover:bg-slate-700 hover:text-white disabled:text-slate-500',
            {
                'bg-slate-700 font-bold': active,
                'text-slate-300': !active,
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
