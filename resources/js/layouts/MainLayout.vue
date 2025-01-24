<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'
import AuthButtons from './_partials/AuthButtons.vue'
import LoginModal from './_partials/LoginModal.vue'

const loginModal = ref(false)

onMounted(() => {
    console.log(usePage().props.auth)
})
</script>

<template>
    <div>
        <LoginModal v-model="loginModal" />
        <AuthButtons @login-click="loginModal = true" />

        <slot />
    </div>
</template>
