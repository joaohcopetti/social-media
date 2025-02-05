<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { useAuthStore } from '@/stores/auth-store'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
defineEmits(['login-click', 'subscribe-click'])

const authStore = useAuthStore()

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
</script>

<template>
    <div class="fixed right-0 top-0 z-50 flex gap-3 rounded-bl-xl p-3 px-5">
        <template v-if="!authStore.user">
            <AppButton
                color="primary-dark"
                label="Entre"
                :icon="{ icon: 'ph:sign-in-fill' }"
                @click="$emit('login-click')"
            />
            <AppButton
                label="Assine"
                color="light"
            />
        </template>
        <template v-else>
            <AppButton
                v-if="authStore.authIs('admin')"
                :icon="{ icon: 'ph:gauge' }"
                color="primary"
                label="Painel"
                :inertia-link-attrs="{ href: route('panel.profiles.index') }"
            />
            <AppButton
                label="Sair"
                :disabled="isLoading"
                ghost
                @click.prevent="onLogoutClick"
            />
        </template>
    </div>
</template>
