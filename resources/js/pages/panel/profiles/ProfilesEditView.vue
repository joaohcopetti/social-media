<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import { Profile } from '@/types/models'
import ProfilesForm from './form/ProfilesForm.vue'

const PROFILES_INDEX_ROUTE = route('panel.profiles.index')

defineProps<{
    profile: Profile
}>()
</script>

<template>
    <AppPanelContainer>
        <template #header>
            <AppButton
                label="Voltar"
                :inertia-link-attrs="{ href: PROFILES_INDEX_ROUTE }"
            />
        </template>
        <template #title> Altere dados do perfil </template>
        <template #body>
            <ProfilesForm :profile="profile" />
        </template>
    </AppPanelContainer>
</template>
