<script setup lang="ts">
import { DropdownItem } from '@/types/components'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Icon } from '@iconify/vue/dist/iconify.js'
import { Link } from '@inertiajs/vue3'
import AppButton from './AppButton.vue'

defineEmits(['click'])

defineProps<{
    label?: string
    icon?: InstanceType<typeof Icon>['$props']
    items: DropdownItem[]
}>()

const getComponent = (item: DropdownItem) => {
    if (item.href && item.openInNewTab) {
        return 'a'
    }

    if (item.href) {
        return Link
    }

    return 'button'
}
</script>

<template>
    <Menu
        as="div"
        class="inline-block"
    >
        <MenuButton
            :as="AppButton"
            v-bind="{
                icon,
                label,
                ghost: true,
            }"
        />

        <Transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right overflow-hidden rounded-md bg-slate-700 shadow-lg focus:outline-none"
            >
                <div
                    v-for="item in items"
                    :key="item.label"
                >
                    <MenuItem v-slot="{ active }">
                        <Component
                            :is="getComponent(item)"
                            :href="item.href"
                            :target="item.openInNewTab ? '_blank' : undefined"
                            :class="[
                                active ? 'bg-slate-600 text-gray-100' : 'text-gray-200',
                                'flex w-full items-center gap-2 px-2 py-2 text-sm active:bg-slate-500',
                            ]"
                            @click="item.onClick"
                        >
                            <Icon
                                v-if="icon"
                                :icon="item.icon!"
                            />
                            <span>{{ item.label }}</span>
                        </Component>
                    </MenuItem>
                </div>
            </MenuItems>
        </Transition>
    </Menu>
</template>
