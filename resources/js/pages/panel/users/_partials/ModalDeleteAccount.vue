<script setup lang="ts">
import AppModal from '@/components/AppModal.vue'

import AppButton from '@/components/AppButton.vue'

const isOpen = defineModel<boolean>()
</script>

<template>
    <AppModal v-model="isOpen">
        <template #title>Você tem certeza?</template>
        <template #body>
            <div class="my-14 text-center">
                Seus dados e assinatura serão excluídos permanentemente
            </div>

            <div class="flex gap-2">
                <AppButton
                    class="w-full"
                    color="success"
                    label="Deletar minha conta"
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
