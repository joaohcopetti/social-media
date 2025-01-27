import { usePage } from '@inertiajs/vue3'
import { defineStore } from 'pinia'
import { computed } from 'vue'

export const useAuthStore = defineStore('auth', () => {
    const user = computed(() => usePage().props.auth.user || null)

    return {
        user,
    }
})
