<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppTextarea from '@/components/AppTextarea.vue'

const a = ''
</script>

<template>
    <form>
        <div class="flex gap-5">
            <div>
                <label
                    class="flex size-64 cursor-pointer items-center justify-center rounded-lg bg-slate-600 text-xl font-bold text-gray-100 transition-colors hover:bg-slate-500 active:bg-slate-600"
                >
                    <input
                        type="file"
                        hidden
                    />
                    Adicionar foto
                </label>
            </div>
            <div class="flex w-full flex-col">
                <div>
                    <AppInput
                        label="Nome"
                        name="name"
                        :input-attrs="{
                            placeholder: 'Digite o nome...',
                        }"
                    />
                </div>
                <div>
                    <AppTextarea
                        name="description"
                        label="Descrição do perfil"
                        placeholder="Digite uma descrição para o perfil..."
                        :textarea-attrs="{ class: 'h-20' }"
                    />
                </div>
                <div class="text-right">
                    <AppButton
                        label="Cadastrar"
                        color="success"
                        type="submit"
                    />
                </div>
            </div>
        </div>
    </form>
</template>
