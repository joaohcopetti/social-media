<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
    progress: number
}>()

const computedProgress = computed(() => +(props.progress - 100))
</script>

<template>
    <div class="relative size-6">
        <svg
            class="size-ful l -rotate-90"
            viewBox="0 0 36 36"
            xmlns="http://www.w3.org/2000/svg"
        >
            <circle
                cx="18"
                cy="18"
                r="10"
                fill="none"
                class="stroke-current text-gray-200 dark:text-slate-500"
                stroke-width="4"
            />
            <circle
                cx="18"
                cy="18"
                r="10"
                fill="none"
                class="stroke-current text-green-600 dark:text-green-500"
                stroke-width="4"
                stroke-dasharray="100"
                :stroke-dashoffset="computedProgress"
                stroke-linecap="round"
            />
        </svg>
    </div>
</template>
