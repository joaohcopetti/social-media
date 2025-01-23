<script setup lang="ts">
import { Profile } from '@/types/models'
import { inject } from 'vue'
import { profileInjectionKey } from '../injection'

const profile = inject(profileInjectionKey) as Profile
</script>

<template>
    <h1 class="font-fancy text-center text-4xl font-extrabold text-white">
        {{ profile.name }}
    </h1>
</template>
