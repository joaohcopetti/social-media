<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppPanelContainer from '@/components/AppPanelContainer.vue'
import { User } from '@/types/models'
import { ref } from 'vue'
import ModalUserEdit from './_partials/ModalUserEdit.vue'
import ModalUserNew from './_partials/ModalUserNew.vue'
import UsersTable from './_partials/UsersTable.vue'

defineProps<{
    users: any
}>()

const newUserModal = ref(false)
const editUserModal = ref<{ isOpen: boolean; user: User | null }>({
    isOpen: false,
    user: null,
})

const onUserEdit = ({ user }: any) => {
    editUserModal.value.user = user
    editUserModal.value.isOpen = true
}
</script>

<template>
    <AppPanelContainer no-horizontal-padding>
        <template #header>
            <AppButton
                label="Novo usuário"
                color="success"
                @click.prevent="newUserModal = true"
            />
        </template>
        <template #title><div class="px-5">Usuários</div></template>
        <template #subtitle><div class="px-5">Gerenciamento de usuários do sistema</div></template>
        <template #body>
            <ModalUserNew v-model="newUserModal" />
            <ModalUserEdit
                v-model="editUserModal.isOpen"
                :user="editUserModal.user!"
            />

            <UsersTable
                :users="users"
                @edit="onUserEdit"
            />
        </template>
    </AppPanelContainer>
</template>
