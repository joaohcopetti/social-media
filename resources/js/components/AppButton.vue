<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'

const COLOR_CLASSES = {
    'primary': 'bg-blue-700 hover:bg-blue-600 hover:text-white ',
    'primary-dark': 'bg-slate-800 hover:bg-slate-700 hover:text-white ',
    'light': 'bg-gray-300 text-gray-900 hover:bg-gray-200',
}

withDefaults(
    defineProps<{
        color?: keyof typeof COLOR_CLASSES
        label?: string
        icon?: InstanceType<typeof Icon>['$props']
        disabled?: boolean
    }>(),
    {
        color: 'primary',
        label: '',
        icon: undefined,
        disabled: false,
    },
)
</script>

<template>
    <button
        class="scale-100 rounded-lg px-6 py-2 font-bold transition-all hover:scale-[1.03] active:scale-100"
        :class="[
            COLOR_CLASSES[color],
            {
                'flex items-center gap-1': !!icon,
                'disabled:cursor-not-allowed disabled:bg-gray-500 disabled:text-gray-200': disabled,
            },
        ]"
        :disabled="disabled"
    >
        <Icon
            v-if="icon"
            v-bind="icon"
        />
        {{ label }}
    </button>
</template>
