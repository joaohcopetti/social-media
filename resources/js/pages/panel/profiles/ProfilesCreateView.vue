<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppContainer from '@/components/AppContainer.vue'
import ProfileForm from './form/ProfileForm.vue'

const PROFILES_INDEX_ROUTE = route('panel.profiles.index')
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
            <template #title> Cadastre um novo perfil </template>
            <template #body>
                <ProfileForm />
            </template>
        </AppContainer>
    </div>
</template>
