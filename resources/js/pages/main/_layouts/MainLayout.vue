<script setup lang="ts">
import { useAppStore } from '@/stores/app-store'
import { useAuthStore } from '@/stores/auth-store'
import { computed, provide, ref } from 'vue'
import HeaderButtons from './_partials/HeaderButtons.vue'
import LoginModal from './_partials/LoginModal.vue'
import RegisterModal from './_partials/RegisterModal.vue'
import { isGuestInjectionKey, isProfileRouteInjectionKey } from './injection'

const loginModal = ref(false)
const registerModal = ref(false)

const appStore = useAppStore()
const authStore = useAuthStore()

const isGuest = computed(() => !authStore.user)
const isProfileRoute = computed(() => appStore.currentRoute.startsWith('profile.'))

const onRegisterFromLoginClick = () => {
    loginModal.value = false

    setTimeout(() => {
        registerModal.value = true
    }, 300)
}

const onLoginFromRegisterClick = () => {
    registerModal.value = false

    setTimeout(() => {
        loginModal.value = true
    }, 300)
}

provide(isProfileRouteInjectionKey, isProfileRoute)
provide(isGuestInjectionKey, isGuest)
</script>

<template>
    <div class="h-full">
        <LoginModal
            v-if="isGuest"
            v-model="loginModal"
            @register-click="onRegisterFromLoginClick"
        />

        <RegisterModal
            v-if="isProfileRoute"
            v-model="registerModal"
            @login-click="onLoginFromRegisterClick"
        />

        <HeaderButtons
            @login-click="loginModal = true"
            @subscribe-click="registerModal = true"
        />

        <slot />
    </div>
</template>
