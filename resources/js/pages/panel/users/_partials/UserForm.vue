<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import AppSwitch from '@/components/AppSwitch.vue'
import { useForm } from '@inertiajs/vue3'

const emit = defineEmits(['submitted'])
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    is_admin: false,
})

const submit = () => {
    form.post(route('panel.users.store'), {
        preserveState: true,
        onSuccess() {
            emit('submitted', form.data())
        },
    })
}
</script>

<template>
    <AppForm
        :form="form"
        @submit.prevent="submit"
    >
        <AppInput
            v-model="form.name"
            label="Nome"
            name="name"
            :input-attrs="{
                placeholder: 'Digite o nome...',
            }"
            :error="form.errors.name"
        />

        <AppInput
            v-model="form.email"
            label="E-mail"
            name="email"
            :input-attrs="{
                placeholder: 'Digite o e-mail...',
            }"
            :error="form.errors.email"
        />

        <AppInput
            v-model="form.password"
            label="Senha"
            name="password"
            :hint="form.password"
            :input-attrs="{
                type: 'password',
                placeholder: 'Senha do usuário...',
            }"
            :error="form.errors.password"
        />

        <AppInput
            v-model="form.password_confirmation"
            label="Repita a senha"
            name="password_confirmation"
            :hint="form.password_confirmation"
            :input-attrs="{
                type: 'password',
                placeholder: 'Repita a senha do usuário...',
            }"
            :error="form.errors.password_confirmation"
        />

        <AppSwitch
            v-model="form.is_admin"
            label="Administrador"
            class="mb-5"
        />

        <AppButton
            type="submit"
            label="Cadastrar"
            color="success"
            class="w-full"
            :disabled="form.processing"
        />
    </AppForm>
</template>
