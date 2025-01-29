<script setup lang="ts">
import { inputFileToBase64 } from '@/utils/helpers'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { ref } from 'vue'

const emit = defineEmits(['change'])

defineProps<{
    photo?: string
    error?: string
}>()

const photoBase64 = ref<string>('')

const onPhotoChange = async (event: Event) => {
    const target = event.target as HTMLInputElement

    if (target.files?.length) {
        photoBase64.value = (await inputFileToBase64(target.files[0])) as string
        emit('change', target.files[0])
        return
    }

    emit('change', null)
    photoBase64.value = ''
}
</script>

<template>
    <div>
        <label
            v-auto-animate
            class="group relative flex size-64 cursor-pointer flex-col items-center justify-center gap-3 overflow-hidden rounded-lg bg-slate-600 text-lg font-bold text-gray-100 transition-colors hover:bg-slate-500 hover:text-white active:bg-slate-600"
            :class="{
                'border border-red-400': error,
            }"
        >
            <input
                type="file"
                name="photo"
                hidden
                accept="image/.jpeg,.png,.jpg"
                @change="onPhotoChange"
            />
            <template v-if="!photoBase64 && !photo">
                <div>
                    <Icon
                        icon="ph:image-fill"
                        style="font-size: 3rem"
                    />
                </div>
                <div>Adicionar foto principal</div>
            </template>
            <template v-else>
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 opacity-0 transition-opacity group-hover:opacity-100"
                >
                    <div>
                        <Icon
                            icon="ph:image-fill"
                            style="font-size: 3rem"
                        />
                    </div>
                    <div>Alterar foto</div>
                </div>
                <div class="size-64 overflow-hidden rounded-lg">
                    <img
                        :src="photoBase64 || photo"
                        class="h-full w-full"
                    />
                </div>
            </template>
        </label>
        <div
            v-auto-animate
            class="mt-2"
        >
            <div
                v-if="error"
                class="text-sm text-red-400"
            >
                {{ error }}
            </div>
        </div>
    </div>
</template>
