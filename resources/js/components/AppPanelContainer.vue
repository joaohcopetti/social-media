<script setup lang="ts">
withDefaults(
    defineProps<{
        noHorizontalPadding?: boolean
    }>(),
    {
        noHorizontalPadding: false,
    },
)
</script>

<template>
    <div>
        <div class="mb-5">
            <slot name="header" />
        </div>
        <div
            class="rounded-lg bg-slate-800 p-5"
            :class="{ 'px-0': noHorizontalPadding }"
        >
            <div class="mb-2 text-xl font-bold text-gray-100">
                <slot name="title" />
            </div>
            <div class="mb-5 text-sm text-gray-400">
                <slot name="subtitle" />
            </div>

            <div>
                <slot name="body" />
            </div>
        </div>
    </div>
</template>
