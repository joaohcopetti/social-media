<script setup lang="ts">
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppTextarea from '@/components/AppTextarea.vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { useForm } from '@inertiajs/vue3'

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

const onPhotoChange = (event: Event) => {
    const target = event.target as HTMLInputElement

    if (target.files?.length) {
        form.photo = target.files[0]
    }
}

const submit = () => {
    console.log('submit')
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex gap-5">
            <div>
                <label
                    class="flex size-64 cursor-pointer flex-col items-center justify-center gap-3 rounded-lg bg-slate-600 text-lg font-bold text-gray-100 transition-colors hover:bg-slate-500 hover:text-white active:bg-slate-600"
                >
                    <input
                        type="file"
                        hidden
                        @change="onPhotoChange"
                    />
                    <div>
                        <Icon
                            icon="ph:image-fill"
                            style="font-size: 3rem"
                        />
                    </div>
                    <div>Adicionar foto principal</div>
                </label>
            </div>
            <div class="flex w-full flex-col">
                <div>
                    <AppInput
                        label="Nome"
                        name="name"
                        :input-attrs="{
                            placeholder: 'Digite o nome...',
                        }"
                    />
                </div>
                <div>
                    <AppTextarea
                        name="description"
                        label="Descrição do perfil"
                        placeholder="Digite uma descrição para o perfil..."
                        :textarea-attrs="{ class: 'h-20' }"
                    />
                </div>
                <div class="text-right">
                    <AppButton
                        label="Continuar"
                        color="success"
                        type="submit"
                    />
                </div>
            </div>
        </div>
    </form>
</template>
