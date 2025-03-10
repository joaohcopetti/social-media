<script setup lang="ts">
import AppPanelContainer from '@/components/AppPanelContainer.vue'

import AppButton from '@/components/AppButton.vue'
import AppHead from '@/components/AppHead.vue'
import { User } from '@/types/models'
import { ref } from 'vue'
import ModalDeleteAccount from './_partials/ModalDeleteAccount.vue'
import UserForm from './_partials/UserForm.vue'

defineProps<{
    user: User
}>()

const isModalDeleteOpen = ref(false)
</script>

<template>
    <AppPanelContainer class="mx-auto sm:w-1/2">
        <template #title>Minha conta</template>
        <template #subtitle> Altere os dados da sua conta </template>
        <template #body>
            <AppHead title="Minha conta" />

            <UserForm
                :user="user"
                is-my-account-page
            />
            <AppButton
                ghost
                color="danger"
                class="mt-2 w-full"
                label="Excluir conta"
                @click="isModalDeleteOpen = true"
            />
            <ModalDeleteAccount v-model="isModalDeleteOpen" />
        </template>
    </AppPanelContainer>
</template>
