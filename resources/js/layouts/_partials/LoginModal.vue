<script setup>
import AppModal from '@/components/AppModal.vue'
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
            <form @submit.prevent="submit">
                <div>
                    <input
                        v-model="form.email"
                        type="text"
                        name="email"
                    />
                </div>
                <div>
                    <input
                        v-model="form.password"
                        type="password"
                        name="password"
                    />
                </div>
                <div>
                    <button>Entrar</button>
                </div>
            </form>
        </template>
    </AppModal>
</template>
