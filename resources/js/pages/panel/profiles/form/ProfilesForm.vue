<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppForm from '@/components/AppForm.vue'
import AppInput from '@/components/AppInput.vue'
import AppSwitch from '@/components/AppSwitch.vue'
import AppTextarea from '@/components/AppTextarea.vue'
import { useAppStore } from '@/stores/app-store'
import { Profile } from '@/types/models'
import { useForm } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'
import ProfilesFormSection from './ProfilesFormSection.vue'
import ProfilesPhotoInput from './ProfilesPhotoInput.vue'

type ProfileForm = {
    name: string
    description?: string
    photo: File | null
    is_user: boolean
    email?: string
    password?: string
    password_confirmation?: string
    facebook: string
    instagram: string
    x_twitter: string
    tiktok: string
    youtube: string
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
    is_user: false,
    email: '',
    password: '',
    password_confirmation: '',
    facebook: '',
    instagram: '',
    x_twitter: '',
    tiktok: '',
    youtube: '',
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
        is_user: !!profile.user,
    })

    profile.social_networks.forEach((socialNetwork) => {
        form[socialNetwork.name] = socialNetwork.pivot.url
    })
}

const isUserRoute = computed(() => useAppStore().currentRouteContains('panel.user.my-profile'))

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
        <div class="flex flex-col gap-5 sm:flex-row">
            <div class="mx-auto sm:mx-0">
                <ProfilesPhotoInput
                    :photo="profile?.photo_url"
                    :error="form.errors.photo"
                    @change="((form.photo = $event), form.clearErrors('photo'))"
                />
            </div>
            <div class="flex w-full flex-col">
                <ProfilesFormSection title="Dados principais">
                    <AppInput
                        v-model="form.name"
                        label="Nome"
                        name="name"
                        :error="form.errors.name"
                        :input-attrs="{
                            placeholder: 'Digite o nome...',
                        }"
                    />
                    <AppTextarea
                        v-model="form.description"
                        :error="form.errors.description"
                        name="description"
                        label="Descrição do perfil"
                        placeholder="Digite uma descrição para o perfil..."
                        :textarea-attrs="{ class: 'h-20' }"
                        optional
                    />
                    <AppSwitch
                        v-if="!isEdit"
                        v-model="form.is_user"
                        label="Usuário do sistema"
                        hint="O usuário pode logar com e-mail e senha e gerenciar seu próprio perfil"
                    />
                </ProfilesFormSection>
                <template v-if="!isUserRoute">
                    <div
                        v-auto-animate
                        class="mt-5"
                    >
                        <ProfilesFormSection
                            v-if="form.is_user"
                            title="Dados de login"
                        >
                            <AppInput
                                v-model="form.email"
                                name="email"
                                label="E-mail"
                                :error="form.errors.email"
                                :input-attrs="{
                                    placeholder: 'Digite o e-mail...',
                                }"
                            />
                            <AppInput
                                v-model="form.password"
                                name="password"
                                label="Senha"
                                :error="form.errors.password"
                                :hint="form.password"
                                :input-attrs="{
                                    type: 'password',
                                    placeholder: 'Digite a senha...',
                                }"
                            />
                            <AppInput
                                v-model="form.password_confirmation"
                                name="password_confirmation"
                                label="Repita a senha"
                                :error="form.errors.password_confirmation"
                                :hint="form.password_confirmation"
                                :input-attrs="{
                                    type: 'password',
                                    placeholder: 'Digite a senha...',
                                }"
                            />
                        </ProfilesFormSection>
                    </div>
                </template>

                <ProfilesFormSection title="Redes sociais">
                    <AppInput
                        v-model="form.facebook"
                        name="networks.facebook"
                        label="Facebook"
                        :input-attrs="{ placeholder: 'Perfil do Facebook...' }"
                        optional
                        :error="form.errors.facebook"
                    />
                    <AppInput
                        v-model="form.instagram"
                        name="networks.instagram"
                        label="Instagram"
                        :input-attrs="{ placeholder: 'Perfil do Instagram...' }"
                        optional
                        :error="form.errors.instagram"
                    />
                    <AppInput
                        v-model="form.x_twitter"
                        name="networks.x_twitter"
                        label="X/Twitter"
                        :input-attrs="{ placeholder: 'Perfil do Twitter...' }"
                        optional
                        :error="form.errors.x_twitter"
                    />
                    <AppInput
                        v-model="form.tiktok"
                        name="networks.tiktok"
                        label="Tiktok"
                        :input-attrs="{ placeholder: 'Perfil do Tiktok...' }"
                        optional
                        :error="form.errors.tiktok"
                    />
                    <AppInput
                        v-model="form.youtube"
                        name="networks.youtube"
                        label="YouTube"
                        :input-attrs="{ placeholder: 'Perfil do YouTube...' }"
                        optional
                        :error="form.errors.youtube"
                    />
                </ProfilesFormSection>

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
