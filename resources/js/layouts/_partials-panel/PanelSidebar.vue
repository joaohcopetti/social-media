<script setup>
import PanelSidebarItem from '@/layouts/_partials-panel/PanelSidebarItem.vue'
import { useAppStore } from '@/stores/app-store'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { computed } from 'vue'
import PanelSidebarHeader from './PanelSidebarHeader.vue'

const appStore = useAppStore()

const sidebarItems = computed(() => [
    {
        label: 'Perfis',
        url: route('panel.profiles.index'),
        isActive: appStore.currentRoute.includes('panel.profiles'),
        icon: 'ph:user-square-duotone',
    },
    {
        label: 'Usuários',
        url: route('panel.users.index'),
        isActive:
            appStore.currentRoute.includes('panel.users') &&
            !appStore.currentRoute.includes('panel.users.my-account'),
        icon: 'ph:users-three-duotone',
    },
    {
        label: 'Minha conta',
        url: route('panel.users.my-account'),
        isActive: appStore.currentRoute.includes('panel.users.my-account'),
        icon: 'ph:user-circle-duotone',
    },
])
</script>

<template>
    <button
        type="button"
        class="ms-3 mt-2 inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 sm:hidden dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    >
        <span class="sr-only">Open sidebar</span>
        <Icon icon="ph:list" />
    </button>

    <aside
        class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full transition-transform sm:translate-x-0"
        aria-label="Sidebar"
    >
        <div class="h-full overflow-y-auto bg-gray-50 px-3 py-4 dark:bg-slate-800">
            <PanelSidebarHeader />
            <ul class="space-y-2 font-medium">
                <PanelSidebarItem
                    v-for="sidebarItem in sidebarItems"
                    :key="sidebarItem.url"
                    :label="sidebarItem.label"
                    :active="sidebarItem.isActive"
                    :url="sidebarItem.url"
                    :icon="sidebarItem.icon"
                />
            </ul>
        </div>
    </aside>
</template>
