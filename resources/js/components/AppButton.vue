<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/iconify.js';

const COLOR_CLASSES = {
    primary: 'bg-primary hover:bg-blue-500',
    success: 'bg-success hover:bg-green-400',
    gray: 'bg-gray-700 hover:bg-gray-600 active:bg-gray-500 text-gray-300',
};

interface AppButtonProps {
    label?: string;
    color?: keyof typeof COLOR_CLASSES;
    icon?: InstanceType<typeof Icon>['$props'];
    disabled?: boolean;
    animated?: boolean;
    block?: boolean;
    variant?: 'text' | 'outline';
}

defineProps<AppButtonProps>();
</script>

<template>
    <button>
        <slot />
    </button>
</template>
