<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppHead from '@/components/AppHead.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import ProfilesTable from './_partials/ProfilesTable.vue'

defineProps<{
    profiles: any
}>()
</script>

<template>
    <AppHead title="Perfis" />

    <AppPanelContainer no-horizontal-padding>
        <template #header>
            <AppButton
                :disabled="profiles.total >= 1"
                :icon-left="{ icon: 'ph:plus-bold' }"
                color="success"
                label="Novo perfil"
                :inertia-link="{ href: route('panel.profiles.create') }"
            />
        </template>

        <template #title>
            <div class="px-5">Perfis</div>
        </template>

        <template #subtitle>
            <div class="px-5">Gerenciamento de perfis</div>
            <div
                v-if="profiles.total >= 1"
                class="px-5"
            >
                Limite de 1 perfil por enquanto, pois o único perfil do sistema é o mesmo linkado
                com o sistema de pagamentos
            </div>
        </template>

        <template #body>
            <ProfilesTable :profiles="profiles" />
        </template>
    </AppPanelContainer>
</template>
