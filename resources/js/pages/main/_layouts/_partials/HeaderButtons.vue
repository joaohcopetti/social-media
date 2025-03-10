<script setup lang="ts">
// @ts-nocheck
import AppButton from '@/components/AppButton.vue'
import { useAuthStore } from '@/stores/auth-store'
import { router, usePage } from '@inertiajs/vue3'
import { computed, inject, ref } from 'vue'
import { isGuestInjectionKey, isProfileRouteInjectionKey } from '../injection'

defineEmits(['login-click', 'subscribe-click'])

const authStore = useAuthStore()
const page = usePage()

const isProfileRoute = inject(
    isProfileRouteInjectionKey,
    computed(() => false),
)

const isGuest = inject(
    isGuestInjectionKey,
    computed(() => false),
)

const isLoading = ref<boolean>(false)

const subscription = computed(() => page.props?.subscription)
const profile = computed(() => page.props?.profile)

const panelUrl = computed(() => {
    if (authStore.userHasAnyRole('influencer')) {
        return route('panel.my-media.manage')
    }

    if (authStore.userHasAnyRole('admin')) {
        return route('panel.profiles.index')
    }

    return route('panel.my-account.edit')
})

const subscribeUrl = computed(() =>
    isProfileRoute ? route('profile.subscribe', { profile: route().params.profile }) : undefined,
)

const showRealSubscribeBtn = computed(
    () =>
        isProfileRoute &&
        !isGuest.value &&
        profile.value?.stripe_price_id &&
        authStore.user?.profile?.id !== profile.value?.id,
)

const isSubscribeDisabled = computed(
    () => subscription.value?.is_active || subscription.value?.stripe_status === 'incomplete',
)

const subscriptionLabel = computed(() => {
    if (subscription.value?.stripe_status === 'incomplete') {
        return 'Pendente'
    }

    return subscription.value?.is_active ? 'Assinado' : 'Assine'
})

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
</script>

<template>
    <div
        class="fixed right-0 z-20 flex gap-3 rounded-bl-3xl p-3 px-5 backdrop-blur-md sm:top-0 sm:backdrop-blur-0"
        :class="{
            'bg-black/60 sm:bg-transparent': !isGuest,
        }"
    >
        <AppButton
            v-if="isProfileRoute && isGuest"
            label="Assine"
            color="light"
            @click="$emit('subscribe-click')"
        />

        <AppButton
            v-if="showRealSubscribeBtn"
            :label="subscriptionLabel"
            :class="
                isSubscribeDisabled
                    ? 'bg-transparent'
                    : 'bg-gradient-to-tr from-red-500 to-purple-700 shadow-lg shadow-purple-700/30'
            "
            :link="{
                href: subscribeUrl!,
            }"
            :disabled="isSubscribeDisabled"
        />

        <template v-if="isGuest">
            <AppButton
                color="primary"
                label="Entre"
                :icon-left="{ icon: 'ph:sign-in-fill' }"
                @click="$emit('login-click')"
            />
        </template>

        <template v-else>
            <AppButton
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
