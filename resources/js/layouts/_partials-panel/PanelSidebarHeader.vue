<script setup lang="ts">
import { useAuthStore } from '@/stores/auth-store'
import { Icon } from '@iconify/vue/dist/iconify.js'

const authStore = useAuthStore()
</script>

<template>
    <div class="flex flex-col items-center gap-3">
        <Icon
            style="font-size: 4rem"
            icon="ph:user-circle-duotone"
        />
        <div class="text-center font-bold">{{ authStore.user.name }}</div>
        <hr class="my-5 self-stretch border-slate-600" />
    </div>
</template>
