<script setup lang="ts">
import type { ProfileMedia } from '@/types/models'
import { ref } from 'vue'
import ProfileMediaPreview from '../_partials/ProfileMediaPreview.vue'
import ProfileMediaViewer from '../_partials/ProfileMediaViewer.vue'
import ProfileContentEmpty from './ProfileContentEmpty.vue'

defineProps<{
    media: ProfileMedia[]
}>()

const mediaSelected = ref<ProfileMedia | null>()

const onMediaSelect = (media: ProfileMedia) => {
    mediaSelected.value = media
}
</script>

<template>
    <div>
        <ProfileMediaViewer
            :media="mediaSelected"
            @dismiss="mediaSelected = null"
        />

        <div
            v-if="media.length"
            class="grid grid-cols-3 gap-2"
        >
            <ProfileMediaPreview
                v-for="_media in media"
                :key="_media.id"
                :media="_media"
                @selected="onMediaSelect"
            />
        </div>
        <ProfileContentEmpty v-else />
    </div>
</template>
