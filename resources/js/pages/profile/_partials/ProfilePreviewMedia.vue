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
            class="absolute inset-0 flex items-center justify-center rounded bg-black opacity-0 transition-opacity group-hover:opacity-50"
        />
        <div
            v-if="media.type === 'video'"
            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
        >
            <Icon
                icon="ph:play-fill"
                class="size-10 shadow"
            />
        </div>
        <img
            :src="media.thumbnail_url"
            style="min-width: 160px; min-height: 160px"
            class="object-cover"
        />
    </div>
</template>
