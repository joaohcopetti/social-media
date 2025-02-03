<script setup lang="ts">
import type { Profile, ProfileMedia } from '@/types/models'
import { type Component, inject } from 'vue'
import ProfileTabs from './_partials/ProfileTabs.vue'
import ProfileContentHome from './contents/ProfileContentHome.vue'
import ProfileContentMedia from './contents/ProfileContentMedia.vue'
import { profileInjectionKey } from './injection'

defineProps<{
    media: ProfileMedia[]
}>()

const profile = inject(profileInjectionKey) as Profile

const COMPONENT_ROUTE_MAP: { [prop: string]: Component } = {
    'profile.index': ProfileContentHome,
    'profile.free': ProfileContentMedia,
    'profile.premium': ProfileContentMedia,
}
</script>

<template>
    <div>
        <ProfileTabs :profile="profile" />
        <div class="mx-3 my-2">
            <Component
                :is="COMPONENT_ROUTE_MAP[route().current() as string]"
                :media="media"
            />
        </div>
    </div>
</template>
