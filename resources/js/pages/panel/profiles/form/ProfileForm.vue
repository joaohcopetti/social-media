<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import AppTextarea from '@/components/AppTextarea.vue'
import { useForm } from '@inertiajs/vue3'
import ProfilePhotoInput from './ProfilePhotoInput.vue'

type ProfileForm = {
    name: string
    description?: string
    photo: File | null
}

const form = useForm<ProfileForm>({
    name: '',
    description: '',
    photo: null,
})

const submit = () => {
    form.post(route('panel.profiles.store'))
}
</script>

<template>
    <AppForm
        :form="form"
        @submit.prevent="submit"
    >
        <div class="flex gap-5">
            <div>
                <ProfilePhotoInput
                    :error="form.errors.photo"
                    @change="((form.photo = $event), form.clearErrors('photo'))"
                />
            </div>
            <div class="flex w-full flex-col">
                <div>
                    <AppInput
                        v-model="form.name"
                        label="Nome"
                        name="name"
                        :error="form.errors.name"
                        :input-attrs="{
                            placeholder: 'Digite o nome...',
                        }"
                    />
                </div>
                <div>
                    <AppTextarea
                        v-model="form.description"
                        :error="form.errors.description"
                        name="description"
                        label="Descrição do perfil"
                        placeholder="Digite uma descrição para o perfil..."
                        :textarea-attrs="{ class: 'h-20' }"
                    />
                </div>
                <div class="text-right">
                    <AppButton
                        :disabled="form.processing"
                        label="Continuar"
                        color="success"
                        type="submit"
                    />
                </div>
            </div>
        </div>
    </AppForm>
</template>
