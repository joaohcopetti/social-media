<script setup lang="ts">
import { useAuthStore } from '@/stores/auth-store'
import { ref } from 'vue'
import AuthButtons from './_partials-main/AuthButtons.vue'
import LoginModal from './_partials-main/LoginModal.vue'

const loginModal = ref(false)
const authStore = useAuthStore()
</script>

<template>
    <div>
        <LoginModal v-model="loginModal" />

        <AuthButtons
            v-if="!authStore.user"
            @login-click="loginModal = true"
        />

        <slot />
    </div>
</template>
