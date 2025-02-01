<script setup lang="ts">
import { Profile } from '@/types/models'
import {
    base64ToFile,
    buildFormData,
    inputImageToBase64,
    inputVideoToBase64,
} from '@/utils/helpers'
import { Icon } from '@iconify/vue/dist/iconify.js'
import axios from 'axios'
import { each, pick, uniqueId } from 'lodash-es'
import { computed, onMounted, ref } from 'vue'
import ProfileMediaPreview from './ProfileMediaPreview.vue'

export type Media = {
    id?: number
    uniqueId: string
    name: string
    size: number
    base64?: string | ArrayBuffer | null
    url?: string
    file: File | null
    thumbnailFile: File | null
    free: boolean
    main: boolean
    progress?: number
    index: number
    type: string
}

const props = defineProps<{
    profile: Profile
}>()

const media = ref<Media[]>([])

const hasMedia = computed(() => !!media.value.length)

const onMediaChange = (event: Event) => {
    const target = event.target as HTMLInputElement

    if (!target.files?.length) {
        return
    }

    each(target.files, uploadMedia)
}

const uploadMedia = async (file: File) => {
    const type = getFileType(file)

    if (!['image', 'video'].includes(type)) {
        throw new Error('File type not supported')
    }

    const { thumbnailBase64, thumbnailFile } = await generateThumbnails(file, type)
    const { name, size } = file

    const _media: Media = {
        uniqueId: uniqueId(),
        name,
        size,
        file,
        type,
        free: false,
        main: false,
        base64: thumbnailBase64,
        thumbnailFile,
        index: 1,
    }

    media.value.push(_media)
    storeMedia(_media)
}

const getFileType = (file: File) => {
    return file.type.split('/')[0]
}

const generateThumbnails = async (file: File, type: string) => {
    if (type === 'image') {
        const thumbnailBase64 = await inputImageToBase64(file)

        return { thumbnailBase64, thumbnailFile: null }
    }

    if (type === 'video') {
        const thumbnailBase64 = await inputVideoToBase64(file)

        return { thumbnailBase64, thumbnailFile: base64ToFile(thumbnailBase64, file.name) }
    }

    throw new Error('File type not supported for thumbnail generation')
}

const storeMedia = async (_media: Media) => {
    const formData = buildFormData(pick(_media, ['file', 'free', 'main', 'thumbnailFile', 'index']))
    const uploadedMedia = media.value.find(({ uniqueId }) => uniqueId === _media.uniqueId)
    const url = route('panel.profiles.send-media', { profile: props.profile.slug })

    if (!uploadedMedia) {
        throw new Error("Couldn't find media")
    }

    const { data } = await axios.post(url, formData, {
        onUploadProgress: (progressEvent) => {
            if (!progressEvent.lengthComputable) {
                return
            }

            const percent = (progressEvent.loaded / progressEvent.total!) * 100

            uploadedMedia.progress = percent
        },
    })

    uploadedMedia.id = data.media.id
}

const onMediaRemove = (mediaId: number) => {
    const mediaIndex = media.value.findIndex(({ id }) => id === mediaId)

    media.value.splice(mediaIndex, 1)

    axios.delete(route('panel.profiles.delete-media', { profileMedia: mediaId }))
}

onMounted(() => {
    console.log(props.profile)
})
</script>

<template>
    <div class="flex flex-col gap-3">
        <label
            v-auto-animate
            for="media"
            class="flex min-h-52 w-full flex-col gap-3 rounded-lg border-2 border-slate-500 bg-slate-600 transition-colors hover:bg-slate-500"
            :class="{
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
                        @remove="onMediaRemove"
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
