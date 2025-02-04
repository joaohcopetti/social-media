<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import UsersTable from './_partials/UsersTable.vue'

defineProps<{
    users: any
}>()
</script>

<template>
    <AppPanelContainer no-horizontal-padding>
        <template #header>
            <AppButton
                label="Novo usuário"
                color="success"
                :inertia-link-attrs="{
                    href: '',
                }"
            />
        </template>
        <template #title><div class="px-5">Usuários</div></template>
        <template #subtitle><div class="px-5">Gerenciamento de usuários do sistema</div></template>
        <template #body>
            <UsersTable :users="users" />
        </template>
    </AppPanelContainer>
</template>
