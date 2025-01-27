<script setup>
import AppButton from '@/components/AppButton.vue'

defineEmits(['login-click', 'subscribe-click'])
</script>

<template>
    <div class="fixed right-0 top-0 z-50 flex gap-3 rounded-bl-xl p-3 px-5">
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
    </div>
</template>
