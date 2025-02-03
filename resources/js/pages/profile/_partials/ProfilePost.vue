<script setup lang="ts">
import type { ProfileMedia } from '@/types/models'

defineProps<{
    media: ProfileMedia
}>()
</script>

<template>
    <div
        class="overflow-hidden rounded-xl"
        :class="media.type === 'image' ? 'w-full' : ''"
    >
        <img
            v-if="media.type === 'image'"
            class="w-full"
            :src="media.url"
        />
        <video
            v-else
            :src="media.url"
            controls
            controlslist="nodownload"
            disablepictureinpicture
            preload="metadata"
            :poster="media.thumbnail_url"
        />
    </div>
</template>
