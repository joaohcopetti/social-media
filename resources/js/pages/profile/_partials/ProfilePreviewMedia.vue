<script setup lang="ts">
import { ProfileMedia } from '@/types/models'
import { Icon } from '@iconify/vue/dist/iconify.js'

defineProps<{
    media: ProfileMedia
}>()
</script>

<template>
    <div
        class="group relative cursor-pointer overflow-hidden rounded"
        style="min-width: 160px; min-height: 160px"
    >
        <div
            class="absolute inset-0 z-50 flex items-center justify-center rounded bg-black opacity-0 transition-opacity group-hover:opacity-50"
        >
            <Icon
                icon="ph:eye"
                class="text-2xl"
            />
        </div>
        <img
            :src="media.thumbnail_url"
            style="min-width: 160px; min-height: 160px"
            class="object-cover"
        />
    </div>
</template>
