<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

const isOpen = defineModel<boolean>('modelValue')
</script>

<template>
    <TransitionRoot
        appear
        :show="isOpen"
        as="template"
    >
        <Dialog
            as="div"
            class="relative z-50"
            @close="isOpen = false"
        >
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/75" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto overflow-x-hidden">
                <div class="flex min-h-full w-screen items-center justify-center p-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-base-500 p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                v-if="$slots['title']"
                                as="h3"
                                class="text-lg font-bold leading-6 text-gray-300"
                            >
                                <slot name="title" />
                            </DialogTitle>
                            <slot name="body" />
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
