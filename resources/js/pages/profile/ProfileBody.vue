<script setup lang="ts">
import type { Profile, ProfileMedia } from '@/types/models'
import { type Component, inject } from 'vue'
import ProfileTabs from './_partials/ProfileTabs.vue'
import ProfileContentFree from './contents/ProfileContentFree.vue'
import ProfileContentHome from './contents/ProfileContentHome.vue'
import ProfileContentPremium from './contents/ProfileContentPremium.vue'
import { profileInjectionKey } from './injection'

defineProps<{
    media: ProfileMedia[]
}>()

const profile = inject(profileInjectionKey) as Profile

const COMPONENT_TABS: { [prop: string]: Component } = {
    'profile.index': ProfileContentHome,
    'profile.free': ProfileContentFree,
    'profile.premium': ProfileContentPremium,
}
</script>

<template>
    <div>
        <ProfileTabs :profile="profile" />
        <div class="mx-3 my-2">
            <Component
                :is="COMPONENT_TABS[route().current() as string]"
                :media="media"
            />
        </div>
    </div>
</template>
