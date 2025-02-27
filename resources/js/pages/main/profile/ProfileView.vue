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
    isSubscribed: boolean
}>()

provide(profileInjectionKey, props.profile)
</script>

<template>
    <div>
        <ProfileBackground />
        <div class="sm:py-10">
            <div
                class="relative z-10 mx-auto overflow-hidden rounded-3xl bg-slate-900 shadow-2xl sm:w-1/3"
            >
                <ProfileHeader />
                <ProfileBody :media="props.media" />
            </div>
        </div>
    </div>
</template>

<style></style>
