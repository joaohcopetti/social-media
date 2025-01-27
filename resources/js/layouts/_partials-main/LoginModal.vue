<script setup>
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppModal from '@/components/AppModal.vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    email: '',
    password: '',
})

const submit = () => {
    form.post(route('login'))
}
</script>

<template>
    <AppModal>
        <template #title>Entre com sua conta</template>
        <template #body>
            <div class="my-5 flex justify-center">
                <Icon
                    style="font-size: 8rem"
                    icon="ph:user-circle-duotone"
                />
            </div>
            <form @submit.prevent="submit">
                <div>
                    <AppInput
                        v-model="form.email"
                        label="E-mail"
                        name="email"
                        :error="form.errors.email"
                    />
                </div>
                <div>
                    <AppInput
                        v-model="form.password"
                        label="Senha"
                        name="password"
                        :input-attrs="{ type: 'password' }"
                        :error="form.errors.password"
                    />
                </div>
                <div class="mt-10">
                    <AppButton
                        class="w-full"
                        label="Entrar"
                        :disabled="form.processing"
                    />
                </div>
            </form>
        </template>
    </AppModal>
</template>
