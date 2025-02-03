<script setup lang="ts">
import AppAbsoluteCenter from '@/components/AppAbsoluteCenter.vue'
import { ProfileMedia } from '@/types/models'
import ProfileMediaPreviewVideoIcon from './ProfileMediaPreviewVideoIcon.vue'

defineProps<{
    media: ProfileMedia
}>()
</script>

<template>
    <div class="group relative min-h-[160px] min-w-[160px] cursor-pointer overflow-hidden rounded">
        <div
            class="absolute inset-0 flex items-center justify-center rounded bg-black opacity-0 transition-opacity group-hover:opacity-50"
        />
        <AppAbsoluteCenter>
            <ProfileMediaPreviewVideoIcon v-if="media.type === 'video'" />
        </AppAbsoluteCenter>
        <img
            :src="media.thumbnail_url"
            class="min-h-[160px] min-w-[160px] object-cover"
        />
    </div>
</template>
