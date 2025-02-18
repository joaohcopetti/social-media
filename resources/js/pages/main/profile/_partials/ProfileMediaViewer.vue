<script setup lang="ts">
import { ProfileMedia } from '@/types/models'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { onBeforeUnmount, onMounted, watch } from 'vue'

const emit = defineEmits(['dismiss', 'selected-media'])

const props = defineProps<{
    media: ProfileMedia[]
    selectedMedia?: ProfileMedia
}>()

const closeOnEscPress = (e: KeyboardEvent) => {
    if (e.key === 'Escape') {
        emit('dismiss')
    }
}

onMounted(() => {
    window.addEventListener('keydown', closeOnEscPress)
})

onBeforeUnmount(() => {
    window.removeEventListener('keydown', closeOnEscPress)
})

watch(
    () => props.selectedMedia,
    () => {
        if (props.selectedMedia) {
            document.body.classList.add('overflow-y-hidden')
        } else {
            document.body.classList.remove('overflow-y-hidden')
        }
    },
)
</script>

<template>
    <Teleport to="body">
        <div
            v-if="selectedMedia"
            class="fixed inset-0 z-50 flex h-screen flex-col items-center justify-center"
        >
            <div
                class="fixed inset-0 z-10 w-full bg-black/80"
                @click="emit('dismiss')"
            />
            <div class="absolute right-0 top-0 z-50">
                <div
                    class="inline-block cursor-pointer p-3 transition-colors hover:bg-white/50"
                    @click="$emit('dismiss')"
                >
                    <Icon
                        icon="ph:x-bold"
                        class="text-4xl"
                    />
                </div>
            </div>
            <div class="z-20 mt-5 flex h-full w-fit items-center justify-center sm:items-baseline">
                <img
                    v-if="selectedMedia.type === 'image'"
                    :src="selectedMedia.url"
                    class="h-fit max-h-[85vh] w-full"
                    oncontextmenu="return false"
                />
                <video
                    v-if="selectedMedia.type === 'video'"
                    :src="selectedMedia.url"
                    class="max-h-[85vh]"
                    oncontextmenu="return false"
                    controls
                    controlslist="nodownload"
                />
            </div>
            <div
                class="z-20 flex h-[15vh] w-full flex-row justify-start overflow-auto py-2 sm:justify-center"
                @click="$emit('dismiss')"
            >
                <div
                    v-for="_media in media"
                    :key="_media.thumbnail_url"
                    class="group relative flex h-[calc(100%-24px)] min-w-24 items-center justify-center px-2 active:scale-105"
                    oncontextmenu="return false"
                    @click.stop.prevent="$emit('selected-media', _media)"
                >
                    <Icon
                        v-if="_media.type === 'video'"
                        icon="ph:play-fill"
                        class="absolute size-8"
                    />
                    <div
                        class="absolute inset-0 mx-2 cursor-pointer rounded bg-white opacity-0 transition-opacity group-hover:opacity-20"
                    />
                    <img
                        :src="_media.thumbnail_url"
                        class="my-3 h-full w-full rounded object-cover"
                        :class="{
                            'border-2': _media.id === selectedMedia.id,
                        }"
                    />
                </div>
            </div>
        </div>
    </Teleport>
</template>
