<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'
import { Link } from '@inertiajs/vue3'

const COLOR_CLASSES = {
    'primary': 'bg-blue-800 hover:bg-blue-700 active:bg-blue-800 hover:text-white',
    'primary-dark': 'bg-slate-800 hover:bg-slate-700 hover:text-white',
    'danger': 'bg-red-800 hover:bg-red-700 active:bg-red-800 hover:text-white',
    'success': 'bg-green-800 hover:bg-green-700 active:bg-green-800  hover:text-white',
    'light': 'bg-gray-300 text-gray-900 hover:bg-gray-200',
}

withDefaults(
    defineProps<{
        color?: keyof typeof COLOR_CLASSES
        label?: string
        icon?: InstanceType<typeof Icon>['$props']
        disabled?: boolean
        ghost?: boolean
        inertiaLinkAttrs?: InstanceType<typeof Link>['$props']
    }>(),
    {
        color: 'primary',
        label: '',
        icon: undefined,
        disabled: false,
        inertiaLinkAttrs: undefined,
        ghost: false,
    },
)
</script>

<template>
    <Component
        :is="inertiaLinkAttrs ? Link : 'button'"
        class="scale-100 rounded-lg font-bold transition-all"
        v-bind="inertiaLinkAttrs"
        :class="[
            ghost ? 'bg-transparent hover:bg-slate-700 active:bg-slate-600' : COLOR_CLASSES[color],
            {
                'px-6 py-2': !!label,
                'p-3': !label && !!icon,
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
        <template v-if="label">
            {{ label }}
        </template>
    </Component>
</template>
