<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import { directive as vTippy } from 'vue-tippy'

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
    <div
        class="fixed right-0 z-20 flex gap-3 rounded-bl-3xl p-3 px-5 backdrop-blur-md sm:top-0 sm:backdrop-blur-0"
    >
        <AppButton
            v-tippy="{ content: 'Início' }"
            :icon-left="{ icon: 'ph:house-bold' }"
            ghost
            :inertia-link="{ href: route('home') }"
        />
        <AppButton
            v-tippy="{ content: 'Sair' }"
            :disabled="isLoading"
            :icon-left="{ icon: 'ph:sign-out-bold' }"
            ghost
            @click.prevent="onLogoutClick"
        />
    </div>
</template>
