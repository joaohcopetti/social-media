<script setup lang="ts">
import { TabGroup, TabList, TabPanel, TabPanels } from '@headlessui/vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { computed } from 'vue'
import ProfileBodyTabsTab from './ProfileBodyTabsTab.vue'

const ROUTE_TAB_MAP: { [key: string]: number } = {
    'profile.index': 0,
    'profile.free': 1,
    'profile.premium': 2,
}

defineProps<{
    profile: any
}>()

const selectedTab = computed(() => ROUTE_TAB_MAP[route().current() as string])
</script>

<template>
    <div class="mt-5 w-full px-2">
        <TabGroup :selected-index="selectedTab">
            <TabList class="flex w-full justify-between gap-2 rounded-xl bg-slate-900/20 p-1">
                <ProfileBodyTabsTab :href="route('profile.index', { profile: profile.slug })">
                    <span class="flex items-center justify-center gap-2">
                        <Icon icon="ph:house-duotone" />
                        Home
                    </span>
                </ProfileBodyTabsTab>
                <ProfileBodyTabsTab :href="route('profile.free', { profile: profile.slug })">
                    Free
                </ProfileBodyTabsTab>
                <ProfileBodyTabsTab :href="route('profile.premium', { profile: profile.slug })">
                    Premium
                </ProfileBodyTabsTab>
            </TabList>

            <TabPanels class="mt-10">
                <TabPanel class="mx-2 my-3">
                    <slot name="home" />
                </TabPanel>
                <TabPanel class="mx-2 my-3">
                    <slot name="free" />
                </TabPanel>
                <TabPanel class="mx-2 my-3">
                    <slot name="premium" />
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>
