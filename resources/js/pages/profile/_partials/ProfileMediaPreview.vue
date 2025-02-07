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
        class="group relative max-h-[160px] min-h-[160px] cursor-pointer overflow-hidden rounded"
        @click.prevent="$emit('selected', media)"
    >
        <div
            class="absolute inset-0 flex h-full w-full items-center justify-center rounded bg-black opacity-0 transition-opacity group-hover:opacity-50"
        />
        <AppAbsoluteCenter>
            <ProfileMediaPreviewVideoIcon v-if="media.type === 'video'" />
        </AppAbsoluteCenter>
        <img
            :src="media.thumbnail_url"
            class="h-full w-full object-cover"
        />
    </div>
</template>
