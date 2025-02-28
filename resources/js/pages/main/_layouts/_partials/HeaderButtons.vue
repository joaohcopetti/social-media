<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { useAuthStore } from '@/stores/auth-store'
import { router, usePage } from '@inertiajs/vue3'
import { computed, inject, ref } from 'vue'
import { isProfileRouteInjectionKey } from '../injection'

defineEmits(['login-click', 'subscribe-click'])

const authStore = useAuthStore()
const page = usePage()

const isLoading = ref<boolean>(false)

const isProfileRoute = inject(isProfileRouteInjectionKey, false)

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

    if (authStore.userHasAnyRole('admin')) {
        return route('panel.profiles.index')
    }

    return route('panel.my-account.edit')
})

const subscribeUrl = computed(() =>
    isProfileRoute ? route('profile.subscribe', { profile: route().params.profile }) : undefined,
)

const showRealSubscribeBtn = computed(
    // @ts-expect-error "stripe_price_id" field is optional
    () => isProfileRoute && authStore.user && page.props?.profile?.stripe_price_id,
)

const isUserSubscribed = computed(() => page.props?.isSubscribed as boolean)
</script>

<template>
    <div
        class="fixed right-0 z-20 flex gap-3 rounded-bl-3xl p-3 px-5 backdrop-blur-md sm:top-0 sm:backdrop-blur-0"
        :class="{
            'bg-black/60 sm:bg-transparent': !!authStore.user,
        }"
    >
        <AppButton
            v-if="isProfileRoute && !authStore.user"
            label="Assine"
            color="light"
            @click="$emit('subscribe-click')"
        />

        <AppButton
            v-if="showRealSubscribeBtn"
            :label="isUserSubscribed ? 'Assinado' : 'Assine'"
            :class="{
                'bg-gradient-to-tr from-red-500 to-purple-700 shadow-lg shadow-purple-700/30':
                    !isUserSubscribed,
                'bg-transparent': isUserSubscribed,
            }"
            :link="{
                href: subscribeUrl!,
            }"
            :disabled="isUserSubscribed"
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
