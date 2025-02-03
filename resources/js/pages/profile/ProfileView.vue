<script setup lang="ts">
import type { Profile, ProfileMedia } from '@/types/models'
import { provide } from 'vue'
import ProfileBackground from './ProfileBackground.vue'
import ProfileBody from './ProfileBody.vue'
import ProfileHeader from './ProfileHeader.vue'
import { profileInjectionKey } from './injection'

const props = defineProps<{
    profile: Profile
    media: ProfileMedia[]
}>()

provide(profileInjectionKey, props.profile)
</script>

<template>
    <div>
        <ProfileBackground />
        <div
            class="relative z-10 mx-auto my-10 w-1/3 overflow-hidden rounded-b-lg rounded-t-3xl bg-slate-900 shadow-2xl"
        >
            <ProfileHeader />
            <ProfileBody :media="props.media" />
        </div>
    </div>
</template>

<style></style>
