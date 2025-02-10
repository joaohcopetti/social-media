<script setup lang="ts">
defineProps<{
    title?: string
    description?: string
}>()
</script>
<template>
    <div class="flex w-full flex-col">
        <h1 class="text-lg font-bold">{{ title }}</h1>
        <hr class="my-3 border-slate-600" />

        <div>
            <div
                v-if="description"
                class="mb-5 text-sm text-gray-400"
            >
                {{ description }}
            </div>
            <div>
                <slot />
            </div>
        </div>
    </div>
</template>
