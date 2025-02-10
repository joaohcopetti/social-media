import { usePage } from '@inertiajs/vue3'
import { map } from 'lodash-es'
import { defineStore } from 'pinia'
import { computed } from 'vue'

type Roles = 'admin' | 'influencer'

export const useAuthStore = defineStore('auth', () => {
    const user = computed(() => usePage().props.auth.user || null)

    const userHasAnyRole = (role: Roles) =>
        map(user.value.roles, 'name').some((name) => name === role)

    const userHasRoles = (roles: Roles[]) => user.value.roles.every((role) => roles.includes(role))

    return {
        user,
        userHasAnyRole,
        userHasRoles,
    }
})
