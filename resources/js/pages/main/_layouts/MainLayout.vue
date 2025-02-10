<script setup lang="ts">
import { ref } from 'vue'
import AuthButtons from './_partials/AuthButtons.vue'
import LoginModal from './_partials/LoginModal.vue'
const loginModal = ref(false)
</script>

<template>
    <div class="h-full">
        <LoginModal v-model="loginModal" />

        <AuthButtons @login-click="loginModal = true" />

        <slot />
    </div>
</template>
