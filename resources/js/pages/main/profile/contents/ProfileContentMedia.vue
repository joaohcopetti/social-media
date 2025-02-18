<script setup lang="ts">
import type { ProfileMedia } from '@/types/models'
import { ref } from 'vue'
import ProfileMediaPreview from '../_partials/ProfileMediaPreview.vue'
import ProfileMediaViewer from '../_partials/ProfileMediaViewer.vue'
import ProfileContentEmpty from './ProfileContentEmpty.vue'

defineProps<{
    media: ProfileMedia[]
}>()

const selectedMedia = ref<ProfileMedia>()

const onMediaSelect = (_media: ProfileMedia) => {
    selectedMedia.value = _media
}
</script>

<template>
    <div>
        <ProfileMediaViewer
            :media="media"
            :selected-media="selectedMedia"
            @dismiss="selectedMedia = undefined"
            @selected-media="selectedMedia = $event"
        />
        <div
            v-if="media.length"
            id="media-container"
            class="grid grid-cols-3 gap-2"
        >
            <ProfileMediaPreview
                v-for="_media in media"
                :key="_media.id"
                :media="_media"
                @click.prevent="onMediaSelect(_media)"
            />
        </div>
        <ProfileContentEmpty v-else />
    </div>
</template>
