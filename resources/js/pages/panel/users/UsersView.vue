<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'

defineProps<{
    users: any
}>()
</script>

<template>
    <AppPanelContainer>
        <template #header>
            <AppButton
                label="Novo usuário"
                color="success"
                :inertia-link-attrs="{
                    href: '',
                }"
            />
        </template>
        <template #title>Usuários</template>
        <template #subtitle> Gerenciamento de usuários do sistema </template>
        <template #body> Olá mundo </template>
    </AppPanelContainer>
</template>
