<script setup lang="ts">
import AppModal from '@/components/AppModal.vue'

import AppButton from '@/components/AppButton.vue'
import { ref } from 'vue'
import UserForm from './UserForm.vue'

const isOpen = defineModel<boolean>()
const submitted = ref<boolean>(false)
const submittedData = ref<any>({})

const onSubmit = (data: any) => {
    submittedData.value = data
    submitted.value = true
}

const resetData = () => {
    submitted.value = false
    submittedData.value = {}
}
</script>

<template>
    <AppModal
        v-model="isOpen"
        @hidden="resetData"
    >
        <template #title>
            <template v-if="!submitted">Cadastre um novo usuário </template>
            <template v-else>Usuário cadastrado!</template>
        </template>
        <template #body>
            <UserForm
                v-if="!submitted"
                @submitted="onSubmit"
            />

            <div v-else>
                <div class="mb-5 text-center">Credenciais para login</div>
                <div class="mb-10 flex flex-col gap-2 text-center text-xl">
                    <div>
                        E-mail: <b class="text-white">{{ submittedData.email }}</b>
                    </div>
                    <div>
                        Senha: <b class="text-white">{{ submittedData.password }}</b>
                    </div>
                </div>
                <AppButton
                    label="Entendido"
                    class="w-full"
                    @click.prevent="isOpen = false"
                />
            </div>
        </template>
    </AppModal>
</template>
