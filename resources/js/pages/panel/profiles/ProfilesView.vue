<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import ProfilesTable from './_partials/ProfilesTable.vue'

const props = defineProps<{
    profiles: any
}>()
</script>

<template>
    <AppPanelContainer no-horizontal-padding>
        <template #header>
            <AppButton
                color="success"
                label="Novo perfil"
                :inertia-link-attrs="{ href: route('panel.profiles.create') }"
            />
        </template>

        <template #title>
            <div class="px-5">Perfis</div>
        </template>

        <template #subtitle> <div class="px-5">Gerenciamento de perfis</div> </template>

        <template #body>
            <ProfilesTable :profiles="profiles" />
        </template>
    </AppPanelContainer>
</template>
