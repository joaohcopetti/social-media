<script setup lang="ts">
import AppAbsoluteCenter from '@/components/AppAbsoluteCenter.vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import type { Media } from './ProfileMediaForm.vue'
import ProfileMediaFormPreviewDeleteBtn from './ProfileMediaFormPreviewDeleteBtn.vue'
import ProfileMediaFormPreviewSwitches from './ProfileMediaFormPreviewSwitches.vue'

defineEmits(['toggle', 'remove'])

defineProps<{
    media: Media
    order: number
}>()
</script>

<template>
    <div
        class="relative w-full overflow-hidden rounded-lg bg-slate-700 shadow hover:outline hover:outline-2"
    >
        <div class="relative">
            <AppAbsoluteCenter v-if="media.type == 'video'">
                <Icon
                    class="size-12 rounded-full bg-black/30 p-2"
                    icon="ph:play-fill"
                />
            </AppAbsoluteCenter>

            <ProfileMediaFormPreviewDeleteBtn
                v-if="media.progress === undefined || media.progress >= 100"
                @click="$emit('remove', media.id)"
            />

            <img
                class="max-h-40 min-h-40 w-full object-cover"
                :src="(media.base64 as string) || media.url"
            />
        </div>

        <ProfileMediaFormPreviewSwitches
            :media="media"
            @toggle="$emit('toggle', $event)"
        />
    </div>
</template>
