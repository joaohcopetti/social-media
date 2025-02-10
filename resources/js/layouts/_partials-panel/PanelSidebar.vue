<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import PanelSidebarItem from '@/layouts/_partials-panel/PanelSidebarItem.vue'
import { useAppStore } from '@/stores/app-store'
import { useAuthStore } from '@/stores/auth-store'
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import PanelSidebarHeader from './PanelSidebarHeader.vue'

const appStore = useAppStore()
const authStore = useAuthStore()

const isOpen = ref<boolean>(false)

export type SidebarItem = {
    label: string
    url: string
    isActive: boolean
    icon: string
    visible: boolean
}

const sidebarItems = computed((): SidebarItem[] => [
    {
        label: 'Perfis',
        url: route('panel.profiles.index'),
        isActive: appStore.currentRoute!.includes('panel.profiles'),
        icon: 'ph:users-duotone',
        visible: authStore.userHasRole('admin'),
    },
    {
        label: 'Usuários',
        url: route('panel.users.index'),
        isActive:
            appStore.currentRoute!.includes('panel.users') &&
            !appStore.currentRoute!.includes('panel.users.my-account'),
        icon: 'ph:user-list-duotone',
        visible: authStore.userHasRole('admin'),
    },
    {
        label: 'Meu perfil',
        url: route('panel.user.my-profile'),
        isActive: false,
        icon: 'ph:user-focus-duotone',
        visible: authStore.userHasRole('influencer'),
    },
    {
        label: 'Minhas mídias',
        url: route('panel.user.my-media'),
        isActive: false,
        icon: 'ph:images-duotone',
        visible: authStore.userHasRole('influencer'),
    },
    {
        label: 'Minha conta',
        url: route('panel.user.my-account'),
        isActive: appStore.currentRoute!.includes('panel.user.my-account'),
        icon: 'ph:user-circle-duotone',
        visible: authStore.userHasRole('influencer') || authStore.userHasRole('admin'),
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
        :icon-left="{ icon: isOpen ? 'ph:x-bold' : 'ph:list-bold' }"
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
                <template
                    v-for="sidebarItem in sidebarItems"
                    :key="sidebarItem.url"
                >
                    <PanelSidebarItem
                        v-if="sidebarItem.visible"
                        :item="sidebarItem"
                    />
                </template>
            </ul>
        </div>
    </aside>
</template>
