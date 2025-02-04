<script setup lang="ts">
import AppPanelContainer from '@/components/AppPanelContainer.vue'

import { User } from '@/types/models'
import UserForm from './_partials/UserForm.vue'

defineProps<{
    user: User
}>()
</script>

<template>
    <AppPanelContainer class="mx-auto w-1/2">
        <template #title>Minha conta</template>
        <template #subtitle> Altere os dados da sua conta </template>
        <template #body>
            <UserForm
                :user="user"
                is-my-account-page
            />
        </template>
    </AppPanelContainer>
</template>
