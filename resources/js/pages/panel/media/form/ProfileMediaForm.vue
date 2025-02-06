<script setup lang="ts">
import { Profile } from '@/types/models'
import {
    base64ToFile,
    buildFormData,
    fileToBase64,
    generateVideoThumbnail,
    getFileType,
} from '@/utils/helpers'
import { Icon } from '@iconify/vue/dist/iconify.js'
import axios, { AxiosError } from 'axios'
import { each, pick, uniqueId } from 'lodash-es'
import { computed, onMounted, ref } from 'vue'
import { useToast } from 'vue-toast-notification'
import ProfileMediaFormPreview from './ProfileMediaFormPreview.vue'

export type Media = {
    id?: number
    uniqueId: string
    size: number
    base64?: string | ArrayBuffer | null
    url?: string
    file: File | null
    thumbnailFile: File | null
    isFree: boolean
    showOnHome: boolean
    progress?: number
    index: number
    type: string
}

const props = defineProps<{
    profile: Profile
}>()

const media = ref<Media[]>([])

const hasMedia = computed(() => !!media.value.length)

onMounted(() => {
    populateForm()
})

const populateForm = () => {
    const profileMedia = props.profile.media

    profileMedia.forEach((_media) => {
        media.value.push({
            id: _media.id,
            uniqueId: uniqueId(),
            isFree: _media.is_free,
            showOnHome: _media.show_on_home,
            size: _media.size,
            url: _media.thumbnail_url,
            type: _media.type,
            file: null,
            thumbnailFile: null,
            index: _media.order,
        })
    })
}

const onMediaChange = (event: Event) => {
    const target = event.target as HTMLInputElement

    if (!target.files?.length) {
        return
    }

    each(target.files, async (file) => {
        const _media = await formatMedia(file)

        media.value.push(_media)

        uploadMedia(_media)
    })
}

const formatMedia = async (file: File): Promise<Media> => {
    const type = getFileType(file)

    if (!['image', 'video'].includes(type)) {
        throw new Error('File type not supported')
    }

    const { thumbnailBase64, thumbnailFile } = await generateThumbnails(file, type)

    return {
        uniqueId: uniqueId(),
        size: file.size,
        file,
        type,
        isFree: false,
        showOnHome: false,
        base64: thumbnailBase64,
        thumbnailFile,
        index: 1,
    }
}

const generateThumbnails = async (file: File, type: string) => {
    if (type === 'image') {
        const thumbnailBase64 = await fileToBase64(file)

        return { thumbnailBase64, thumbnailFile: null }
    }

    if (type === 'video') {
        const thumbnailBase64 = await generateVideoThumbnail(file)

        return { thumbnailBase64, thumbnailFile: base64ToFile(thumbnailBase64, file.name) }
    }

    throw new Error('File type not supported for thumbnail generation')
}

const uploadMedia = async (_media: Media) => {
    const formData = buildFormData(pick(_media, ['file', 'free', 'main', 'thumbnailFile', 'index']))
    const uploadedMedia = media.value.find(({ uniqueId }) => uniqueId === _media.uniqueId)
    const url = route('panel.profiles.send-media', { profile: props.profile.slug })

    if (!uploadedMedia) {
        throw new Error("Couldn't find media")
    }

    try {
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
    } catch (e) {
        const error = e as AxiosError

        if (error.request.status === 422) {
            const responseErrors = error.response!.data as { message: string }

            useToast().error(responseErrors.message, { duration: 5000 })
        }

        onMediaRemove(uploadedMedia.uniqueId)
    }
}

const onMediaRemove = async (mediaId: number | string) => {
    const mediaIndex = media.value.findIndex(
        ({ id, uniqueId }) => id === mediaId || uniqueId === mediaId,
    )

    media.value.splice(mediaIndex, 1)

    await axios.delete(route('panel.profiles.delete-media', { profileMedia: mediaId }))
}

const toggleMediaState = (state: string, _media: Media) => {
    axios.post(
        route('panel.profiles.toggle-state', {
            profileMedia: _media.id,
        }),
        { state },
    )

    if (state === 'free') {
        _media.isFree = !_media.isFree
        _media.showOnHome = false
    }

    if (state === 'show-on-home') {
        _media.showOnHome = !_media.showOnHome
    }
}
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
            </template>
            <div v-else>
                <div
                    v-auto-animate
                    class="grid grid-cols-6 gap-3 p-3"
                >
                    <ProfileMediaFormPreview
                        v-for="(_media, index) in media"
                        :key="_media.uniqueId"
                        :media="_media"
                        :order="index + 1"
                        @click.prevent
                        @remove="onMediaRemove"
                        @toggle="toggleMediaState($event, _media)"
                    />
                </div>
            </div>
            <div class="py-5 text-center text-xl font-bold text-gray-100">
                Clique aqui para enviar
            </div>
        </label>
    </div>
</template>
