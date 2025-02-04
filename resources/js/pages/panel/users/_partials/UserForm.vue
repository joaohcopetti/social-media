<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import AppSwitch from '@/components/AppSwitch.vue'
import { User } from '@/types/models'
import { useForm } from '@inertiajs/vue3'
import { map } from 'lodash-es'
import { computed, onMounted } from 'vue'

const emit = defineEmits(['submitted'])

type UserFormProps = {
    name: string
    email: string
    password: string
    password_confirmation: string
    is_admin: boolean
}

const props = defineProps<{
    user: User
}>()

const form = useForm<UserFormProps>({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    is_admin: false,
})

const isEdit = computed(() => !!props.user)

const submit = () => {
    if (!isEdit.value) {
        create()
    } else {
        update()
    }
}

const create = () => {
    form.post(route('panel.users.store'), {
        preserveState: true,
        onSuccess() {
            emit('submitted', form.data())
        },
    })
}

const update = () => {
    form.patch(route('panel.users.update', { user: props.user.id }), {
        preserveState: true,
        onSuccess() {
            emit('submitted')
        },
    })
}

const populateForm = () => {
    const user = props.user

    form.name = user.name
    form.email = user.email
    form.is_admin = map(user.roles, 'name').includes('admin')
}

onMounted(() => {
    if (isEdit.value) {
        populateForm()
    }
})
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
            :label="isEdit ? 'Nova senha' : 'Senha'"
            name="password"
            :hint="form.password"
            :input-attrs="{
                type: 'password',
                placeholder: 'Senha do usuário...',
            }"
            :error="form.errors.password"
        />
        <div class="-mt-4 mb-5 text-xs text-gray-400">Deixe em branco caso não queira alterar</div>

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
            :label="isEdit ? 'Atualizar' : 'Cadastrar'"
            color="success"
            class="w-full"
            :disabled="form.processing"
        />
    </AppForm>
</template>
