<script setup lang="ts">
import { useAppStore } from '@/stores/app-store'
import type { ProfileMedia, Subscription } from '@/types/models'
import { usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import ProfileMediaPreview from '../_partials/ProfileMediaPreview.vue'
import ProfileMediaViewer from '../_partials/ProfileMediaViewer.vue'
import ProfileContentEmpty from './ProfileContentEmpty.vue'

defineProps<{
    media: ProfileMedia[]
}>()

const appStore = useAppStore()
const selectedMedia = ref<ProfileMedia>()

const onMediaSelect = (_media: ProfileMedia) => {
    selectedMedia.value = _media
}

const isPremiumRoute = computed(() => appStore.currentRoute === 'profile.premium')
const subscription = computed(() => usePage().props?.subscription as Subscription | undefined)

const canView = computed(() => {
    if (isPremiumRoute.value) {
        return subscription.value?.stripe_status === 'active'
    }

    return true
})
</script>

<template>
    <div>
        <template v-if="canView">
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
        </template>
        <template v-else>
            <div v-if="subscription?.stripe_status === 'incomplete'">
                O seu pagamento está sendo processado
            </div>
            <div
                v-else
                class="relative my-20 px-5 text-center text-xl"
            >
                Assine para ter acesso ao
                <b
                    class="inline-block bg-gradient-to-tr from-purple-500 to-red-500 bg-clip-text text-transparent"
                >
                    conteúdo premium
                </b>
            </div>
        </template>
    </div>
</template>
