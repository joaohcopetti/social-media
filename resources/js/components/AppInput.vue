<script setup lang="ts">
import { InputHTMLAttributes, onMounted, ref } from 'vue'

const value = defineModel<string>()
const input = ref<HTMLInputElement | null>(null)

type AppInputProps = {
    label: string
    name: string
    inputAttrs?: InputHTMLAttributes
    error?: string
    hint?: string
    autofocus?: boolean
}

const props = withDefaults(defineProps<AppInputProps>(), {
    error: '',
    inputAttrs: undefined,
    hint: '',
    autofocus: false,
})

const onInput = (event: Event) => {
    const target = event.target as HTMLInputElement

    value.value = target.value
}

onMounted(() => {
    if (props.autofocus && input.value) {
        input.value.focus()
    }
})
</script>

<template>
    <div class="mb-5">
        <label
            :for="name"
            class="mb-2 block text-sm font-bold text-slate-900 dark:text-white"
            >{{ label }}</label
        >
        <input
            :id="name"
            ref="input"
            v-model="value"
            :name="name"
            v-bind="inputAttrs"
            class="block w-full rounded-lg border bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-blue-500 focus:ring-blue-500 dark:border dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            :class="{
                'dark:border-red-500': error,
                'border-slate-300 dark:border-slate-600': !error,
            }"
            @input="onInput"
        />
        <div v-auto-animate>
            <p
                v-if="hint"
                class="mt-2 text-sm text-gray-300 dark:text-gray-400"
            >
                {{ hint }}
            </p>
        </div>
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
