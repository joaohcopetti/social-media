<script setup lang="ts">
withDefaults(
    defineProps<{
        label: string
        placeholder?: string
        textareaAttrs?: { [prop: string]: string | number }
        name: string
    }>(),
    {
        placeholder: '',
        textareaAttrs: undefined,
    },
)
</script>
<template>
    <div class="mb-5">
        <label
            :for="name"
            class="mb-2 flex gap-2 text-sm"
        >
            <span class="font-bold text-slate-900 dark:text-white">{{ label }}</span>
            <span>(opcional)</span>
        </label>

        <textarea
            :id="name"
            class="block h-32 w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-blue-500 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            :placeholder="placeholder"
            v-bind="textareaAttrs"
        />
    </div>
</template>
