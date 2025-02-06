<script setup lang="ts">
import AppModal from '@/components/AppModal.vue'

import { User } from '@/types/models'
import UserForm from './UserForm.vue'
const isOpen = defineModel<boolean>()

defineProps<{
    user: User | null
}>()
</script>

<template>
    <AppModal v-model="isOpen">
        <template #title> Alterar dados do perfil </template>

        <template
            v-if="user"
            #body
        >
            <UserForm
                :user="user"
                @submitted="isOpen = false"
            />
        </template>
    </AppModal>
</template>
