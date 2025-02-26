<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import AppModal from '@/components/AppModal.vue'

import { Icon } from '@iconify/vue/dist/iconify.js'
import { useForm } from '@inertiajs/vue3'
import { useToast } from 'vue-toast-notification'

const isOpen = defineModel<boolean>({ default: false })

defineEmits(['login-click'])

defineProps<{
    showLoginText: boolean
}>()

const form = useForm({
    email: '',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('register.store'), {
        onSuccess() {
            isOpen.value = false
            useToast().success('Boas vindas!')
        },
    })
}
</script>

<template>
    <AppModal v-model="isOpen">
        <template #title>Crie uma conta para poder assinar</template>
        <template #body>
            <AppForm
                :form="form"
                @submit.prevent="submit"
            >
                <div class="my-3 flex justify-center">
                    <Icon
                        icon="ph:user-circle-check-duotone"
                        style="font-size: 7rem"
                    />
                </div>
                <AppInput
                    v-model="form.email"
                    label="E-mail"
                    name="email"
                    :input-attrs="{ placeholder: 'Digite seu e-mail...' }"
                    :error="form.errors.email"
                />
                <AppInput
                    v-model="form.password"
                    label="Senha"
                    name="password"
                    :input-attrs="{ placeholder: 'Digite sua senha...', type: 'password' }"
                    :error="form.errors.password"
                    :hint="form.password"
                />
                <AppInput
                    v-model="form.password_confirmation"
                    label="Repita a senha"
                    name="password_confirmation"
                    :hint="form.password_confirmation"
                    :input-attrs="{
                        placeholder: 'Repita sua senha...',
                        type: 'password',
                    }"
                    :error="form.errors.password_confirmation"
                />

                <div v-if="showLoginText">
                    <span
                        class="cursor-pointer text-sm font-bold text-blue-500 hover:text-blue-400"
                        @click="$emit('login-click')"
                    >
                        Já tenho uma conta
                    </span>
                </div>

                <div class="mt-6">
                    <AppButton
                        type="submit"
                        label="Criar conta"
                        color="success"
                        class="w-full"
                        :disabled="form.processing"
                    />
                </div>
            </AppForm>
        </template>
    </AppModal>
</template>
