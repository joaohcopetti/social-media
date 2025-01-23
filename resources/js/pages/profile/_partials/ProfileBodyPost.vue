<script setup lang="ts">
import type { ProfileMedia } from '@/types/models'

defineProps<{
    media: ProfileMedia
}>()
</script>

<template>
    <div class="overflow-hidden rounded-xl">
        <img
            class="w-full"
            :src="media.url"
        />
    </div>
</template>
