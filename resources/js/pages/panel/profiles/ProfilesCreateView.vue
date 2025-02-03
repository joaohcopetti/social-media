<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import ProfileForm from './form/ProfileForm.vue'

import AppPanelContainer from '@/components/AppPanelContainer.vue'
</script>

<template>
    <AppPanelContainer>
        <template #header>
            <AppButton
                label="Voltar"
                :inertia-link-attrs="{ href: route('panel.profiles.index') }"
            />
        </template>
        <template #title> Cadastre um novo perfil </template>
        <template #body>
            <ProfileForm />
        </template>
    </AppPanelContainer>
</template>
