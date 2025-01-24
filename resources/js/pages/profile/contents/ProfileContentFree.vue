<script setup lang="ts">
import type { ProfileMedia } from '@/types/models'
import ProfilePreviewMedia from '../_partials/ProfilePreviewMedia.vue'

defineProps<{
    media: ProfileMedia[]
}>()
</script>

<template>
    <div class="grid grid-cols-3 gap-2">
        <ProfilePreviewMedia
            v-for="_media in media"
            :key="_media.id"
            :media="_media"
        />
    </div>
</template>
