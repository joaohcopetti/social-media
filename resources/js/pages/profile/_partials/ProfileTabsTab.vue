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
            preserve-scroll
            :class="[
                'block text-center transition-all',
                'font-sm w-full rounded-lg py-2 font-bold',
                'ring-offset-white focus:outline-none focus:ring-4',
                selected
                    ? 'bg-white text-base-500 shadow'
                    : 'text-gray-300 hover:bg-slate-700 hover:text-white',
            ]"
        >
            <slot />
        </Link>
    </Tab>
</template>
