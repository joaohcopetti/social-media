<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppHead from '@/components/AppHead.vue'
import ProfilesForm from './form/ProfilesForm.vue'

import AppPanelContainer from '@/components/AppPanelContainer.vue'
</script>

<template>
    <AppHead title="Cadastrar perfil" />
    <AppPanelContainer>
        <template #header>
            <AppButton
                :icon-left="{ icon: 'ph:arrow-circle-left-bold' }"
                label="Voltar"
                :inertia-link="{ href: route('panel.profiles.index') }"
            />
        </template>
        <template #title> Cadastre um novo perfil </template>
        <template #body>
            <ProfilesForm />
        </template>
    </AppPanelContainer>
</template>
