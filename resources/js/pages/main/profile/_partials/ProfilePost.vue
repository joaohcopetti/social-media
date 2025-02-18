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
            class="max-h-[400px] min-h-[400px] w-full object-cover"
            :src="media.url"
            oncontextmenu="return false"
        />
        <video
            v-else
            :src="media.url"
            oncontextmenu="return false"
            controls
            controlslist="nodownload"
            disablepictureinpicture
            preload="metadata"
            :poster="media.thumbnail_url"
        />
    </div>
</template>
