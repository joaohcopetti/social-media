<script setup lang="ts">
import { Profile } from '@/types/models'
import { TabGroup, TabList } from '@headlessui/vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { computed } from 'vue'
import ProfileTabsTab from './ProfileTabsTab.vue'

type ProfileTab = {
    label: string
    slot: string
    icon?: string
    href: string
}

const props = defineProps<{
    profile: Profile
}>()

const ROUTE_TAB_MAP: { [key: string]: number } = {
    'profile.index': 0,
    'profile.free': 1,
    'profile.premium': 2,
}

const TABS: ProfileTab[] = [
    {
        label: 'Home',
        slot: 'home',
        icon: 'ph:house-duotone',
        href: route('profile.index', { profile: props.profile.slug }),
    },
    {
        label: 'Free',
        slot: 'free',
        href: route('profile.free', { profile: props.profile.slug }),
    },
    {
        label: 'Premium',
        slot: 'premium',
        href: route('profile.premium', { profile: props.profile.slug }),
    },
]

const selectedTab = computed(() => ROUTE_TAB_MAP[route().current() as string])
</script>

<template>
    <div class="mt-5 w-full px-2">
        <TabGroup :selected-index="selectedTab">
            <TabList class="flex w-full justify-between gap-2 rounded-xl bg-slate-900/20 p-1">
                <ProfileTabsTab
                    v-for="tab in TABS"
                    :key="tab.label"
                    :href="tab.href"
                >
                    <span class="flex items-center justify-center gap-2">
                        <Icon
                            v-if="tab.icon"
                            :icon="tab.icon"
                        />
                        {{ tab.label }}
                    </span>
                </ProfileTabsTab>
            </TabList>
        </TabGroup>
    </div>
</template>
