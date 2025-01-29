<script setup lang="ts">
const value = defineModel<string>()

withDefaults(
    defineProps<{
        label: string
        placeholder?: string
        textareaAttrs?: { [prop: string]: string | number }
        name: string
        error?: string
    }>(),
    {
        placeholder: '',
        textareaAttrs: undefined,
        error: '',
    },
)

const onInput = (event: Event) => {
    const target = event.target as HTMLInputElement

    value.value = target.value
}
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
            :name="name"
            class="block w-full rounded-lg border bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-blue-500 focus:ring-blue-500 dark:border dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            :class="{
                'dark:border-red-400': error,
                'border-slate-300 dark:border-slate-600': !error,
            }"
            :placeholder="placeholder"
            v-bind="textareaAttrs"
            @input="onInput"
        />
        <div v-auto-animate>
            <p
                v-if="error"
                class="mt-2 text-sm text-red-600 dark:text-red-400"
            >
                {{ error }}
            </p>
        </div>
    </div>
</template>
