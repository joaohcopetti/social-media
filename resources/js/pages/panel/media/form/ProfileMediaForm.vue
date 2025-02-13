<script setup lang="ts">
import { useAppStore } from '@/stores/app-store'
import { Media } from '@/types/components'
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

const props = defineProps<{
    profile: Profile
}>()

const appStore = useAppStore()
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
        index: media.value.length,
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

    const url =
        appStore.currentRoute !== 'panel.my-media.manage'
            ? route('panel.profiles.send-media', { profile: props.profile.slug })
            : route('panel.my-media.upload')

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
            const responseErrors = error.response!.data as { message?: string }

            useToast().error(responseErrors.message || 'Tipo de arquivo não suportado', {
                duration: 5000,
            })
        }

        onMediaRemove(uploadedMedia.uniqueId)
    }
}

const onMediaRemove = async (mediaId: number | string) => {
    const mediaIndex = media.value.findIndex(
        ({ id, uniqueId }) => id === mediaId || uniqueId === mediaId,
    )

    media.value.splice(mediaIndex, 1)

    appStore.currentRoute !== 'panel.my-media.manage'
        ? await axios.delete(route('panel.profiles.delete-media', { profileMedia: mediaId }))
        : await axios.delete(route('panel.my-media.delete', { profileMedia: mediaId }))
}

const toggleMediaState = (state: string, _media: Media) => {
    const routeName =
        appStore.currentRoute !== 'panel.my-media.manage'
            ? 'panel.profiles.toggle-state'
            : 'panel.my-media.toggle-state'

    axios.post(route(routeName, { profileMedia: _media.id }), { state })

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
                    class="grid grid-cols-2 gap-3 p-3 sm:grid-cols-6"
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
            <div class="py-5 text-center font-bold text-gray-100 sm:text-xl">
                Clique aqui para adicionar
            </div>
        </label>
    </div>
</template>
