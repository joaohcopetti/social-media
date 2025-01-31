<script setup lang="ts">
import AppSwitch from '@/components/AppSwitch.vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import type { Media } from './ProfileMediaForm.vue'
import ProfileMediaPreviewInfo from './ProfileMediaPreviewInfo.vue'

defineEmits(['toggle-free', 'toggle-main'])

defineProps<{
    media: Media
    order: number
}>()
</script>

<template>
    <div class="relative w-full overflow-hidden rounded-lg shadow hover:outline hover:outline-2">
        <div class="relative">
            <div class="absolute bottom-0 left-0 flex overflow-hidden rounded-tr-lg">
                <ProfileMediaPreviewInfo>
                    {{ order }}
                </ProfileMediaPreviewInfo>
                <ProfileMediaPreviewInfo>
                    <Icon :icon="media.type === 'video' ? 'ph:video-fill' : 'ph:image-fill'" />
                </ProfileMediaPreviewInfo>
                <ProfileMediaPreviewInfo
                    v-if="media.progress !== undefined"
                    class="text-xs text-white"
                >
                    {{ media.progress.toFixed(0) }}%
                </ProfileMediaPreviewInfo>
            </div>
            <button
                class="absolute right-0 top-0 flex size-8 items-center justify-center rounded-bl-lg bg-red-500 opacity-80 shadow transition-opacity hover:bg-red-600 hover:opacity-100"
            >
                <Icon
                    icon="ph:trash-fill"
                    class="text-lg"
                />
            </button>
            <img
                class="max-h-40 min-h-40 w-full object-cover"
                :src="(media.base64 as string) || media.url"
            />
        </div>
        <div class="bg-slate-700 text-sm">
            <AppSwitch
                class="p-2"
                size="sm"
                label="Free"
                @update:model-value="$emit('toggle-free', $event)"
            />
        </div>
        <div class="bg-slate-700 text-sm">
            <AppSwitch
                class="p-2"
                size="sm"
                label="Destaque"
                @update:model-value="$emit('toggle-main', $event)"
            />
        </div>
    </div>
</template>
