<script setup lang="ts">
import { Profile } from '@/types/models'
import { inputImageToBase64, inputVideoToBase64 } from '@/utils/helpers'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { uniqueId } from 'lodash-es'
import { computed, ref } from 'vue'
import ProfileMediaPreview from './ProfileMediaPreview.vue'

defineProps<{
    profile: Profile
}>()

export type Media = {
    uniqueId: string
    name: string
    size: number
    base64?: string | ArrayBuffer | null
    url?: string
    file: File | null
    thumbnailFile: File | null
    free: boolean
    main: boolean
    type: 'video' | 'image'
}

const media = ref<Media[]>([])

const hasMedia = computed(() => !!media.value.length)

const onMediaChange = (event: Event) => {
    const target = event.target as HTMLInputElement

    if (!target.files?.length) {
        return
    }

    Object.values(target.files).forEach((file: File) => {
        uploadMedia(file)
    })
}

const uploadMedia = async (file: File) => {
    const type = file.type.includes('image') ? 'image' : 'video'

    const thumbnail = file.type.includes('image')
        ? await inputImageToBase64(file)
        : await inputVideoToBase64(file)

    media.value.push({
        uniqueId: uniqueId(),
        file,
        free: false,
        main: false,
        name: file.name,
        size: file.size,
        base64: thumbnail,
        thumbnailFile: null,
        type,
    })
}
</script>

<template>
    <div class="flex flex-col gap-3">
        <label
            v-auto-animate
            for="media"
            class="flex min-h-52 w-full flex-col gap-3 rounded-lg border-2 border-slate-500 bg-slate-600 transition-colors hover:bg-slate-500"
            :class="{
                '': hasMedia,
                'items-center justify-center': !hasMedia,
            }"
        >
            <input
                id="media"
                type="file"
                name="media"
                accept=".png,.jpg,.mp4,.jpeg"
                hidden
                multiple
                @change="onMediaChange"
            />
            <template v-if="!hasMedia">
                <div>
                    <Icon
                        style="font-size: 3.5rem"
                        icon="ph:image-fill"
                    />
                </div>
                <div class="w-full text-center text-xl font-bold text-gray-100">
                    Envie ou arraste e solte aqui
                </div>
            </template>
            <div v-else>
                <div
                    v-auto-animate
                    class="grid grid-cols-6 gap-3 p-3"
                >
                    <ProfileMediaPreview
                        v-for="(_media, index) in media"
                        :key="_media.uniqueId"
                        :media="_media"
                        :order="index + 1"
                        @click.prevent
                        @toggle-free="_media.free = $event"
                        @toggle-main="_media.main = $event"
                    />
                </div>
                <div class="py-5 text-center text-xl font-bold text-gray-100">
                    Envie ou arraste e solte aqui
                </div>
            </div>
        </label>
    </div>
</template>
