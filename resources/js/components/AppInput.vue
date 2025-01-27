<script setup lang="ts">
const value = defineModel<string>()

withDefaults(
    defineProps<{
        label: string
        name: string
        inputAttrs?: { [prop: string]: string | number }
        error?: string
    }>(),
    {
        error: '',
        inputAttrs: undefined,
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
            class="mb-2 block text-sm font-bold text-gray-900 dark:text-white"
            >{{ label }}</label
        >
        <input
            :id="name"
            v-bind="inputAttrs"
            class="block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            :class="{
                'text-red-600 dark:border-red-500': error,
                'border-gray-300': !error,
            }"
            @input="onInput"
        />
        <div v-auto-animate>
            <p
                v-if="error"
                class="mt-2 text-sm text-red-600 dark:text-red-500"
            >
                {{ error }}
            </p>
        </div>
    </div>
</template>
