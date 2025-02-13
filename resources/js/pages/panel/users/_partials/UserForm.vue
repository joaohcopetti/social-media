<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import { User } from '@/types/models'
import { useForm } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'
import { useToast } from 'vue-toast-notification'

const emit = defineEmits(['submitted'])

type UserFormProps = {
    name: string
    email: string
    password: string
    password_confirmation: string
}

const props = withDefaults(
    defineProps<{
        user?: User
        isMyAccountPage?: boolean
    }>(),
    {
        user: undefined,
        isMyAccountPage: false,
    },
)

const form = useForm<UserFormProps>({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const isEdit = computed(() => !!props.user)

const submit = () => {
    if (props.isMyAccountPage) {
        updateMyAccount()
        return
    }

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
    form.patch(route('panel.users.update', { user: props.user!.id }), {
        preserveState: true,
        onSuccess() {
            useToast().success('Perfil atualizado!')
            emit('submitted')
        },
    })
}

const updateMyAccount = () => {
    form.patch(route('panel.user.my-account-update'), {
        onSuccess() {
            form.reset('password', 'password_confirmation')
            useToast().success('Perfil atualizado!')
        },
    })
}

const populateForm = () => {
    const user = props.user!

    form.defaults({
        name: user.name,
        email: user.email,
    })

    form.reset()
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
            autofocus
            :input-attrs="{
                placeholder: !isMyAccountPage ? 'Digite o nome...' : 'Digite seu nome...',
                autofocus: true,
            }"
            :error="form.errors.name"
        />

        <AppInput
            v-model="form.email"
            label="E-mail"
            name="email"
            :input-attrs="{
                placeholder: !isMyAccountPage ? 'Digite o e-mail...' : 'Digite seu e-mail',
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
                placeholder: !isMyAccountPage ? 'Senha do usuário...' : 'Digite sua senha...',
            }"
            :error="form.errors.password"
        />

        <div
            v-if="isEdit"
            class="-mt-4 mb-5 text-xs text-gray-400"
        >
            Deixe em branco caso não queira alterar
        </div>

        <AppInput
            v-model="form.password_confirmation"
            label="Repita a senha"
            name="password_confirmation"
            :hint="form.password_confirmation"
            :input-attrs="{
                type: 'password',
                placeholder: !isMyAccountPage ? 'Repita a senha do usuário...' : 'Repita sua senha',
            }"
            :error="form.errors.password_confirmation"
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
