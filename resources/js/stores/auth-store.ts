import { usePage } from '@inertiajs/vue3'
import { defineStore } from 'pinia'
import { computed } from 'vue'

type Roles = 'admin' | 'influencer'

export const useAuthStore = defineStore('auth', () => {
    const user = computed(() => usePage().props.auth.user || null)

    const userHasAnyRole = (roles: Roles | Roles[]) =>
        Array.isArray(roles)
            ? user.value.roles.some((role) => roles.includes(role.name))
            : user.value.roles.some(({ name }) => name === roles)

    const userHasRoles = (roles: Roles[]) => user.value.roles.every((role) => roles.includes(role))

    return {
        user,
        userHasAnyRole,
        userHasRoles,
    }
})
