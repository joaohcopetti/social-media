<script setup lang="ts">
import { ProfileMedia } from '@/types/models'
import { onBeforeUnmount, onMounted } from 'vue'

const emit = defineEmits(['dismiss'])

defineProps<{
    media?: ProfileMedia | null
}>()

const dismissOnEscPress = (e: KeyboardEvent) => {
    if (e.key === 'Escape') {
        emit('dismiss')
    }
}

onMounted(() => {
    document.addEventListener('keydown', dismissOnEscPress)
})

onBeforeUnmount(() => {
    document.removeEventListener('keydown', dismissOnEscPress)
})
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            enter-active-class="transition-opacity duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
            leave-active-class="transition-opacity duration-200"
        >
            <div
                v-if="media"
                class="fixed inset-0 z-40 bg-black/80"
            />
        </Transition>
        <Transition
            enter-from-class="scale-90 opacity-0"
            enter-to-class="scale-100 opacity-100"
            enter-active-class="transition-all"
            leave-from-class="scale-100 opacity-100"
            leave-to-class="scale-90 opacity-0"
            leave-active-class="transition-all"
        >
            <div
                v-if="media"
                class="fixed inset-0 z-50 flex items-center justify-center"
                @click.prevent="$emit('dismiss')"
            >
                <div
                    class="flex h-5/6 justify-center"
                    @click.stop.prevent
                >
                    <img
                        v-if="media.type === 'image'"
                        :src="media.url"
                        class="h-full"
                    />
                    <video
                        v-else
                        :src="media.url"
                    />
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
