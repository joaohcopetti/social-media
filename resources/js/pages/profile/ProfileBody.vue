<script setup lang="ts">
import type { Profile, ProfileMedia } from '@/types/models'
import { inject } from 'vue'
import ProfileTabs from './_partials/ProfileTabs.vue'
import ProfileContentFree from './contents/ProfileContentFree.vue'
import ProfileContentHome from './contents/ProfileContentHome.vue'
import ProfileContentPremium from './contents/ProfileContentPremium.vue'
import { profileInjectionKey } from './injection'

defineProps<{
    media: ProfileMedia[]
}>()

const profile = inject(profileInjectionKey) as Profile
</script>

<template>
    <ProfileTabs :profile="profile">
        <template
            v-if="route().current() === 'profile.index'"
            #home
        >
            <ProfileContentHome :media="media" />
        </template>
        <template
            v-if="route().current() === 'profile.free'"
            #free
        >
            <ProfileContentFree :media="media" />
        </template>
        <template
            v-if="route().current() === 'profile.premium'"
            #premium
        >
            <ProfileContentPremium :media="media" />
        </template>
    </ProfileTabs>
</template>
