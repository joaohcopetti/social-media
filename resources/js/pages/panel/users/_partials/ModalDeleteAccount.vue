<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppModal from '@/components/AppModal.vue'
import { router } from '@inertiajs/vue3'
import { useToast } from 'vue-toast-notification'

const isOpen = defineModel<boolean>()

const onDeleteClick = () => {
    router.delete(route('panel.my-account.delete'), {
        onSuccess() {
            useToast().success('Conta deletada!')
        },
    })
}
</script>

<template>
    <AppModal v-model="isOpen">
        <template #title>Você tem certeza?</template>
        <template #body>
            <div class="my-14 text-center">
                Seus dados e assinaturas serão excluídos permanentemente
            </div>

            <div class="flex gap-2">
                <AppButton
                    class="w-full"
                    color="success"
                    label="Deletar minha conta"
                    @click="onDeleteClick"
                />
                <AppButton
                    class="w-full"
                    ghost
                    label="Cancelar"
                    @click="isOpen = false"
                />
            </div>
        </template>
    </AppModal>
</template>
