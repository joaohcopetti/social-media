<script setup lang="ts">
import { Profile } from '@/types/models'
import { inject } from 'vue'
import { profileInjectionKey } from '../injection'
import ProfileHeaderSocialIcon from './ProfileHeaderSocialIcon.vue'

const SOCIAL_NETWORK_ICONS: { [prop: string]: any } = {
    facebook: 'fa6-brands:facebook-f',
    instagram: 'fa6-brands:instagram',
    x_twitter: 'fa6-brands:x-twitter',
    tiktok: 'fa6-brands:tiktok',
    youtube: 'fa6-brands:youtube',
}

const profile = inject(profileInjectionKey) as Profile
</script>

<template>
    <div class="flex justify-center gap-2">
        <template
            v-for="socialNetwork in profile.social_networks"
            :key="socialNetwork.name"
        >
            <ProfileHeaderSocialIcon
                href="http://google.com"
                :icon="{ icon: SOCIAL_NETWORK_ICONS[socialNetwork.name] }"
            />
        </template>
    </div>
</template>
