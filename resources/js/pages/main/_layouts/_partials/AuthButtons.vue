<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { useAppStore } from '@/stores/app-store'
import { useAuthStore } from '@/stores/auth-store'
import { router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
defineEmits(['login-click', 'subscribe-click'])

const authStore = useAuthStore()
const appStore = useAppStore()

const isLoading = ref<boolean>(false)

const onLogoutClick = () => {
    isLoading.value = true

    router.post(
        route('logout'),
        {},
        {
            onSuccess() {
                isLoading.value = false
            },
        },
    )
}

const panelUrl = computed(() => {
    if (authStore.userHasAnyRole('influencer')) {
        return route('panel.my-media.manage')
    }

    return route('panel.profiles.index')
})

const showSubscribeBtn = computed(() => appStore.currentRoute.startsWith('profile.'))
const subscribeUrl = computed(() =>
    showSubscribeBtn.value
        ? route('profile.checkout', { profile: route().params.profile })
        : undefined,
)
</script>

<template>
    <div
        class="fixed right-0 z-20 flex gap-3 rounded-bl-3xl p-3 px-5 backdrop-blur-md sm:top-0 sm:backdrop-blur-0"
        :class="{
            'bg-black/60 sm:bg-transparent': authStore.user,
        }"
    >
        <AppButton
            v-if="showSubscribeBtn && subscribeUrl"
            label="Assine"
            color="light"
            :link="{ href: subscribeUrl, target: '_blank' }"
        />
        <template v-if="!authStore.user">
            <AppButton
                color="primary"
                label="Entre"
                :icon-left="{ icon: 'ph:sign-in-fill' }"
                @click="$emit('login-click')"
            />
        </template>
        <template v-else>
            <AppButton
                v-if="authStore.userHasAnyRole(['admin', 'influencer'])"
                v-tippy="{ content: 'Painel' }"
                :icon-left="{ icon: 'ph:gauge-bold' }"
                ghost
                :inertia-link="{ href: panelUrl }"
            />
            <AppButton
                v-tippy="{ content: 'Sair' }"
                :disabled="isLoading"
                :icon-left="{ icon: 'ph:sign-out-bold' }"
                ghost
                @click.prevent="onLogoutClick"
            />
        </template>
    </div>
</template>
