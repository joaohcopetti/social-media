<script setup lang="ts">
import AppSwitch from '@/components/AppSwitch.vue'
import { Media } from '@/types/components'

defineEmits(['toggle'])

defineProps<{
    media: Media
}>()
</script>

<template>
    <div class="text-sm">
        <div>
            <AppSwitch
                :model-value="!!media.isFree"
                class="p-2"
                size="sm"
                label="Free"
                @update:model-value="$emit('toggle', 'free')"
            />
        </div>
        <div v-auto-animate>
            <div v-if="media.isFree">
                <AppSwitch
                    :model-value="!!media.showOnHome"
                    class="p-2"
                    size="sm"
                    label="Destaque"
                    @update:model-value="$emit('toggle', 'show-on-home')"
                />
            </div>
        </div>
    </div>
    <div
        v-if="!media.isFree"
        class="h-full w-full bg-slate-700"
    />
</template>
