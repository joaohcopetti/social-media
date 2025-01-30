<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppContainer from '@/components/AppContainer.vue'
import { Profile } from '@/types/models'
import ProfileHeaderPreview from './_partials/ProfileHeaderPreview.vue'
import ProfileMediaForm from './form/ProfileMediaForm.vue'

defineProps<{
    profile: Profile
}>()
</script>

<template>
    <div>
        <div class="mb-5">
            <AppButton
                label="Voltar"
                :inertia-link-attrs="{
                    href: route('panel.profiles.index'),
                }"
            />
        </div>
        <AppContainer>
            <template #title> Gerenciar mídias do perfil </template>
            <template #body>
                <ProfileHeaderPreview :profile="profile" />
                <hr class="my-10 border-slate-600" />
                <ProfileMediaForm :profile="profile" />
            </template>
        </AppContainer>
    </div>
</template>
