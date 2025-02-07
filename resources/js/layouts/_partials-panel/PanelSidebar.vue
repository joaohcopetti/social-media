<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import PanelSidebarItem from '@/layouts/_partials-panel/PanelSidebarItem.vue'
import { useAppStore } from '@/stores/app-store'
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import PanelSidebarHeader from './PanelSidebarHeader.vue'

const appStore = useAppStore()

const isOpen = ref<boolean>(false)

const sidebarItems = computed(() => [
    {
        label: 'Perfis',
        url: route('panel.profiles.index'),
        isActive: appStore.currentRoute?.includes('panel.profiles'),
        icon: 'ph:user-square-duotone',
    },
    {
        label: 'Usuários',
        url: route('panel.users.index'),
        isActive:
            appStore.currentRoute?.includes('panel.users') &&
            !appStore.currentRoute?.includes('panel.users.my-account'),
        icon: 'ph:users-three-duotone',
    },
    {
        label: 'Minha conta',
        url: route('panel.my-account.index'),
        isActive: appStore.currentRoute?.includes('panel.my-account'),
        icon: 'ph:user-circle-duotone',
    },
])

const toggleSidebar = () => {
    isOpen.value = !isOpen.value

    if (isOpen.value) {
        document.body.classList.add('overflow-y-hidden')
    } else {
        document.body.classList.remove('overflow-y-hidden')
    }
}

const closeSidebar = () => {
    isOpen.value = false
    document.body.classList.remove('overflow-y-hidden')
}

onMounted(() => {
    document.addEventListener('inertia:navigate', closeSidebar)
})

onBeforeUnmount(() => {
    document.removeEventListener('inertia:navigate', closeSidebar)
})
</script>

<template>
    <AppButton
        :icon="{ icon: isOpen ? 'ph:x' : 'ph:list' }"
        type="button"
        ghost
        class="sticky z-50 m-3 sm:hidden"
        @click.prevent="toggleSidebar"
    />

    <Transition
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        enter-active-class="transition-all"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        leave-active-class="transition-all"
    >
        <div
            v-if="isOpen"
            class="absolute inset-0 bg-black/40"
            @click="toggleSidebar"
        />
    </Transition>

    <aside
        class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full transition-transform sm:translate-x-0"
        aria-label="Sidebar"
        :class="{
            'translate-x-0': isOpen,
        }"
    >
        <div class="h-full overflow-y-auto bg-slate-800 px-3 py-4">
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
