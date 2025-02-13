<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import { useAppStore } from '@/stores/app-store'
import { Profile } from '@/types/models'
import ProfileHeaderPreview from './_partials/ProfileHeaderPreview.vue'
import ProfileMediaForm from './form/ProfileMediaForm.vue'

defineProps<{
    profile: Profile
}>()

const appStore = useAppStore()
</script>

<template>
    <AppPanelContainer>
        <template
            v-if="appStore.currentRoute !== 'panel.my-media.manage'"
            #header
        >
            <AppButton
                :icon-left="{ icon: 'ph:arrow-circle-left-bold' }"
                label="Voltar"
                :inertia-link="{
                    href: route('panel.profiles.index'),
                }"
            />
        </template>
        <template #title> Gerenciar mídias do perfil </template>
        <template #body>
            <ProfileHeaderPreview :profile="profile" />
            <hr class="my-10 border-slate-600" />
            <ProfileMediaForm :profile="profile" />
        </template>
    </AppPanelContainer>
</template>
