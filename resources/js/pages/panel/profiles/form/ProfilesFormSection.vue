<script setup lang="ts">
defineProps<{
    title?: string
    description?: string
}>()
</script>
<template>
    <div class="flex w-full flex-col rounded-lg border border-slate-600 p-5">
        <h1 class="mb-1 text-lg font-bold">{{ title }}</h1>

        <div>
            <div
                v-if="description"
                class="mb-5 text-sm text-gray-400"
            >
                {{ description }}
            </div>
            <hr class="my-3 border-slate-600" />
            <div>
                <slot />
            </div>
        </div>
    </div>
</template>
