<script setup lang="ts">
import AppModal from '@/components/AppModal.vue'

import { User } from '@/types/models'
import UserForm from './UserForm.vue'

defineProps<{
    user: User | null
}>()
</script>

<template>
    <AppModal>
        <template #title> Alterar dados do perfil </template>

        <template
            v-if="user"
            #body
        >
            <UserForm :user="user" />
        </template>
    </AppModal>
</template>
