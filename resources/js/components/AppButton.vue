<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const COLOR_CLASSES = {
    'primary': 'bg-blue-700 hover:bg-blue-600 active:bg-blue-800 hover:text-white',
    'primary-dark': 'bg-indigo-700 hover:bg-indigo-600 hover:text-white',
    'danger': 'bg-red-700 hover:bg-red-600 active:bg-red-800 hover:text-white',
    'success': 'bg-green-700 hover:bg-green-600 active:bg-green-800  hover:text-white',
    'light': 'bg-gray-300 text-gray-900 hover:bg-gray-200',
}

type AppButtonProps = {
    color?: keyof typeof COLOR_CLASSES
    label?: string
    iconLeft?: InstanceType<typeof Icon>['$props']
    iconRight?: InstanceType<typeof Icon>['$props']
    disabled?: boolean
    ghost?: boolean
    inertiaLink?: InstanceType<typeof Link>['$props']
    link?: keyof HTMLAnchorElement
}

const props = withDefaults(defineProps<AppButtonProps>(), {
    color: 'primary',
    label: '',
    iconLeft: undefined,
    iconRight: undefined,
    disabled: false,
    ghost: false,
    inertiaLink: undefined,
    link: undefined,
})

const hasIcon = computed(() => !!props.iconLeft || !!props.iconRight)

const component = computed(() => {
    if (props.link) {
        return {
            component: 'a',
            attrs: props.link,
        }
    }

    if (props.inertiaLink) {
        return {
            component: Link,
            attrs: props.inertiaLink,
        }
    }

    return {
        component: 'button',
        attrs: {},
    }
})

const classes = computed(() => {
    const classes = []

    if (props.disabled) {
        classes.push('bg-gray-600 text-gray-400 cursor-default pointer-events-none')
    }

    if (props.ghost) {
        classes.push('bg-transparent hover:bg-white/20 active:bg-white/10')
    }

    if (!props.disabled && !props.ghost) {
        classes.push(COLOR_CLASSES[props.color])
    }

    if (hasIcon.value && !props.label) {
        classes.push('w-10 h-10')
    }

    if (props.label) {
        classes.push('px-4 py-2')
    }

    return [classes, hasIcon.value ? 'flex items-center justify-center gap-2' : 'inline-block']
})
</script>

<template>
    <Component
        :is="component.component"
        v-bind="component.attrs as object"
        class="inline-block rounded-lg font-bold transition-all"
        :class="classes"
        :disabled="disabled ? 'disabled' : undefined"
    >
        <Icon
            v-if="iconLeft"
            v-bind="iconLeft"
        />
        <span v-if="label">{{ label }}</span>
        <Icon
            v-if="iconRight"
            v-bind="iconRight"
        />
    </Component>
</template>
