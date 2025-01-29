<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppContainer from '@/components/AppContainer.vue'
import { Profile } from '@/types/models'
import ProfileForm from './form/ProfileForm.vue'

const PROFILES_INDEX_ROUTE = route('panel.profiles.index')

defineProps<{
    profile: Profile
}>()
</script>

<template>
    <div>
        <div class="mb-5">
            <AppButton
                label="Voltar"
                :inertia-link-attrs="{ href: PROFILES_INDEX_ROUTE }"
            />
        </div>
        <AppContainer>
            <template #title> Altere dados do perfil </template>
            <template #body>
                <ProfileForm :profile="profile" />
            </template>
        </AppContainer>
    </div>
</template>
