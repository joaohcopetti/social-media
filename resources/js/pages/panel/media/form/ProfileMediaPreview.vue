<script setup lang="ts">
import AppRadialProgress from '@/components/AppRadialProgress.vue'
import AppSwitch from '@/components/AppSwitch.vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import type { Media } from './ProfileMediaForm.vue'
import ProfileMediaPreviewInfo from './ProfileMediaPreviewInfo.vue'

defineEmits(['toggle-free', 'toggle-main', 'remove'])

defineProps<{
    media: Media
    order: number
}>()
</script>

<template>
    <div class="relative w-full overflow-hidden rounded-lg shadow hover:outline hover:outline-2">
        <div class="relative">
            <div
                v-if="media.type == 'video'"
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
            >
                <Icon
                    class="size-12 rounded-full bg-black/30 p-2"
                    icon="ph:play-fill"
                />
            </div>
            <div class="absolute bottom-0 left-0 flex overflow-hidden rounded-tr-lg">
                <ProfileMediaPreviewInfo v-if="media.progress !== undefined">
                    <AppRadialProgress :progress="media.progress" />
                </ProfileMediaPreviewInfo>
            </div>
            <button
                class="absolute right-0 top-0 flex size-8 items-center justify-center rounded-bl-lg bg-red-500 opacity-80 shadow transition-opacity hover:bg-red-600 hover:opacity-100"
                @click="$emit('remove', media.id)"
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
                :model-value="!!media.isFree"
                class="p-2"
                size="sm"
                label="Free"
                @update:model-value="$emit('toggle-free', $event)"
            />
        </div>
        <div
            v-if="media.isFree"
            class="bg-slate-700 text-sm"
        >
            <AppSwitch
                :model-value="!!media.showOnHome"
                class="p-2"
                size="sm"
                label="Destaque"
                @update:model-value="$emit('toggle-main', $event)"
            />
        </div>
        <div
            v-else
            class="h-full w-full bg-slate-700"
        />
    </div>
</template>
