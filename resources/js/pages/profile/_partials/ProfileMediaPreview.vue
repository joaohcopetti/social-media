<script setup lang="ts">
import AppAbsoluteCenter from '@/components/AppAbsoluteCenter.vue'
import { ProfileMedia } from '@/types/models'
import ProfileMediaPreviewVideoIcon from './ProfileMediaPreviewVideoIcon.vue'

defineEmits(['selected'])

defineProps<{
    media: ProfileMedia
}>()
</script>

<template>
    <div
        class="group relative max-h-[160px] min-h-[160px] min-w-[160px] max-w-[160px] cursor-pointer overflow-hidden rounded"
        @click.prevent="$emit('selected', media)"
    >
        <div
            class="absolute inset-0 flex items-center justify-center rounded bg-black opacity-0 transition-opacity group-hover:opacity-50"
        />
        <AppAbsoluteCenter>
            <ProfileMediaPreviewVideoIcon v-if="media.type === 'video'" />
        </AppAbsoluteCenter>
        <img
            :src="media.thumbnail_url"
            class="max-h-[160px] min-h-[160px] min-w-[160px] max-w-[160px] object-cover"
        />
    </div>
</template>
