<script setup lang="ts">
import type { Profile, ProfileMedia } from '@/types/models'
import { provide } from 'vue'
import ProfileBackground from './ProfileBackground.vue'
import ProfileBody from './ProfileBody.vue'
import ProfileHeader from './ProfileHeader.vue'
import ProfileContainer from './_partials/ProfileContainer.vue'
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
        <ProfileContainer class="relative z-10 my-10 overflow-hidden rounded-3xl bg-slate-900">
            <ProfileHeader />
            <ProfileBody :media="props.media" />
        </ProfileContainer>
    </div>
</template>

<style></style>
