<script setup lang="ts">
import { ProfileMedia } from '@/types/models'

defineProps<{
    media: ProfileMedia
}>()
</script>

<template>
    <img
        :src="media.thumbnail_url"
        style="min-width: 160px; min-height: 160px"
        class="rounded object-cover"
    />
</template>
