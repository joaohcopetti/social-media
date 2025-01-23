<script setup lang="ts">
import type { Profile, ProfileMedia } from '@/types/models'
import { inject } from 'vue'
import { profileInjectionKey } from '../injection'
import ProfileBodyPost from './ProfileBodyPost.vue'

defineProps<{
    media: ProfileMedia[]
}>()

const profile = inject(profileInjectionKey) as Profile
</script>

<template>
    <div
        v-if="profile.description"
        class="bg-slate-900 p-5 text-center text-lg text-white"
    >
        {{ profile.description }}
    </div>
    <div class="flex flex-col gap-3">
        <ProfileBodyPost
            v-for="_media in media"
            :key="_media.id"
            :media="_media"
        />
    </div>
</template>
