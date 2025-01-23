<script setup lang="ts">
import type { Profile } from '@/types/models'
import { inject } from 'vue'
import ProfileHeaderSocialIcons from './_partials/ProfileHeaderSocialIcons.vue'
import { profileInjectionKey } from './injection'

const profile = inject(profileInjectionKey) as Profile
</script>

<template>
    <div class="relative">
        <img
            class="w-full object-cover"
            :src="profile.photo_url"
        />

        <div
            class="absolute bottom-0 w-full bg-gradient-to-t from-slate-900 to-transparent px-5 py-10"
        >
            <div class="mb-5">
                <h1 class="font-fancy text-center text-4xl font-extrabold text-white">
                    {{ profile.name }}
                </h1>
            </div>

            <ProfileHeaderSocialIcons />
        </div>
    </div>
</template>
