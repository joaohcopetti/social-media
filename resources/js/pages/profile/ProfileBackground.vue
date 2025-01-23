<script setup lang="ts">
import type { Profile } from '@/types/models'
import { inject } from 'vue'
import { profileInjectionKey } from './injection'

const profile = inject(profileInjectionKey) as Profile
</script>

<template>
    <img
        :src="profile.photo_url"
        class="fixed inset-0 h-full w-full"
    />

    <div
        class="fixed inset-0 h-full w-full bg-opacity-50 shadow-[inset_0_10px_100px_15px_black] backdrop-blur-2xl"
    />
</template>
