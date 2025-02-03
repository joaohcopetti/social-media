<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import AppTextarea from '@/components/AppTextarea.vue'
import { Profile } from '@/types/models'
import { useForm } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'
import ProfilesPhotoInput from './ProfilesPhotoInput.vue'

type ProfileForm = {
    name: string
    description?: string
    photo: File | null
    _method: 'POST' | 'PATCH'
}

const props = defineProps<{
    profile?: Profile
}>()

const isEdit = computed(() => !!props.profile)

const form = useForm<ProfileForm>({
    name: '',
    description: '',
    photo: null,
    _method: 'POST',
})

const submit = () => {
    if (isEdit.value) {
        form._method = 'PATCH'
        form.post(route('panel.profiles.update', { profile: props.profile?.slug }))
        return
    }

    form.post(route('panel.profiles.store'))
}

const populateForm = () => {
    const profile = props.profile

    if (!profile) {
        return
    }

    Object.assign(form, {
        name: profile.name,
        description: profile.description,
    })
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
        <div class="flex gap-5">
            <div>
                <ProfilesPhotoInput
                    :photo="profile?.photo_url"
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
                        :label="!isEdit ? 'Continuar' : 'Salvar'"
                        color="success"
                        type="submit"
                    />
                </div>
            </div>
        </div>
    </AppForm>
</template>
