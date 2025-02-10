import { usePage } from '@inertiajs/vue3'
import { map } from 'lodash-es'
import { defineStore } from 'pinia'
import { computed } from 'vue'

export const useAuthStore = defineStore('auth', () => {
    const user = computed(() => usePage().props.auth.user || null)

    const userHasRole = (role: 'admin' | 'influencer') =>
        map(user.value.roles, 'name').includes(role)

    return {
        user,
        userHasRole,
    }
})
