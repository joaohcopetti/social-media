<script setup lang="ts">
import AppModal from '@/components/AppModal.vue'

import { User } from '@/types/models'
import UserForm from './UserForm.vue'

defineProps<{
    user: User
}>()
</script>

<template>
    <AppModal>
        <template #title> Altere dados do perfil </template>

        <template #body>
            <UserForm />
        </template>
    </AppModal>
</template>
