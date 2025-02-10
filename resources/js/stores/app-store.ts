import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAppStore = defineStore('app', () => {
    const currentRoute = ref(route().current() as string)

    const currentRouteContains = (routes: string | string[]) =>
        Array.isArray(routes)
            ? routes.some((route) => currentRoute.value.includes(route))
            : currentRoute.value.includes(routes)

    document.addEventListener('inertia:navigate', () => {
        currentRoute.value = route().current() as string
    })

    return {
        currentRoute,
        currentRouteContains,
    }
})
