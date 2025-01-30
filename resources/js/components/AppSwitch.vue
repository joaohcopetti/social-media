<script setup lang="ts">
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import { computed } from 'vue'

const SIZES_CLASS = {
    sm: {
        'container': 'h-5 w-9',
        'circle': 'h-3 w-3',
        'circle-enabled': 'translate-x-5',
        'circle-disabled': 'translate-x-1',
    },
    md: {
        'container': 'h-6 w-11',
        'circle': 'h-4 w-4',
        'circle-enabled': 'translate-x-6',
        'circle-disabled': 'translate-x-1',
    },
}

const enabled = defineModel<boolean>()
const props = withDefaults(
    defineProps<{
        size?: 'sm' | 'md'
        label?: string
    }>(),
    {
        size: 'md',
        label: '',
    },
)

const classes = computed(() => SIZES_CLASS[props.size])
</script>

<template>
    <SwitchGroup as="div">
        <SwitchLabel
            class="flex w-full items-center gap-2"
            as="div"
        >
            <Switch
                v-model="enabled"
                :class="[enabled ? 'bg-blue-600' : 'bg-slate-500', classes['container']]"
                class="relative inline-flex items-center rounded-full"
            >
                <span
                    :class="[
                        enabled ? classes['circle-enabled'] : classes['circle-disabled'],
                        classes['circle'],
                    ]"
                    class="inline-block transform rounded-full bg-white transition"
                />
            </Switch>
            <span>{{ label }}</span>
        </SwitchLabel>
    </SwitchGroup>
</template>
