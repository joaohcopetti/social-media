<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import { UserForm } from '@/types/components'
import { User } from '@/types/models'
import { useForm } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'
import { useToast } from 'vue-toast-notification'

const emit = defineEmits(['submitted'])

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

const form = useForm<UserForm>({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const isEdit = computed(() => !!props.user)

onMounted(() => {
    if (isEdit.value) {
        populateForm()
    }
})

const populateForm = () => {
    const user = props.user!

    form.defaults({
        name: user.name,
        email: user.email,
    })

    form.reset()
}

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

const updateMyAccount = () => {
    form.patch(route('panel.my-account.update'), {
        onSuccess() {
            form.reset('password', 'password_confirmation')
            useToast().success('Perfil atualizado!')
        },
    })
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
