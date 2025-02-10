<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'
import { Link } from '@inertiajs/vue3'

import type { SidebarItem } from './PanelSidebar.vue'

defineProps<{
    item: SidebarItem
}>()
</script>

<template>
    <li>
        <Link
            :href="item.url"
            class="group flex items-center rounded-lg p-2 text-white transition-colors hover:bg-slate-600"
            :class="{
                'bg-slate-700 font-bold': item.isActive,
            }"
        >
            <Icon
                :icon="item.icon"
                style="font-size: 1.2rem"
            />
            <span class="ms-3">{{ item.label }}</span>
        </Link>
    </li>
</template>
