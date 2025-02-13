<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import { useAppStore } from '@/stores/app-store'
import { Profile } from '@/types/models'
import ProfilesForm from './form/ProfilesForm.vue'

const PROFILES_INDEX_ROUTE = route('panel.profiles.index')

defineProps<{
    profile: Profile
}>()

const appStore = useAppStore()
</script>

<template>
    <AppPanelContainer>
        <template
            v-if="appStore.currentRoute !== 'panel.my-profile.edit'"
            #header
        >
            <AppButton
                :icon-left="{ icon: 'ph:arrow-circle-left-bold' }"
                label="Voltar"
                :inertia-link="{ href: PROFILES_INDEX_ROUTE }"
            />
        </template>
        <template #title> Altere dados do perfil </template>
        <template #body>
            <ProfilesForm :profile="profile" />
        </template>
    </AppPanelContainer>
</template>
