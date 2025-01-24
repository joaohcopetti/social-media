<script setup>
import { Icon } from '@iconify/vue'

defineEmits(['login-click', 'subscribe-click'])
</script>

<template>
    <div class="fixed right-0 top-0 z-50 flex gap-3 rounded-bl-xl p-3 px-5">
        <button
            class="flex items-center gap-1 rounded-lg bg-slate-800 px-6 py-2 font-bold shadow transition-all hover:scale-105 hover:bg-slate-700 hover:text-white active:scale-100"
            @click="$emit('login-click')"
        >
            <Icon icon="ph:sign-in-fill" />
            Entre
        </button>
        <button
            class="rounded-lg bg-gray-300 px-6 py-2 font-bold text-gray-900 shadow transition-all hover:scale-105 hover:bg-gray-200 active:scale-100"
        >
            Assine
        </button>
    </div>
</template>
