<script setup lang="ts">
import { Tab } from '@headlessui/vue'
import { Link } from '@inertiajs/vue3'

defineProps<{
    href: string
}>()
</script>

<template>
    <Tab
        v-slot="{ selected }"
        as="template"
    >
        <Link
            as="a"
            :href="href"
            class="font-sm block w-full rounded-lg py-2 text-center font-bold ring-offset-white transition-all focus:outline-none focus:ring-4"
            preserve-scroll
            :class="[
                selected
                    ? 'bg-white text-slate-700 shadow'
                    : 'text-gray-300 hover:bg-slate-700 hover:text-white',
            ]"
        >
            <slot />
        </Link>
    </Tab>
</template>
