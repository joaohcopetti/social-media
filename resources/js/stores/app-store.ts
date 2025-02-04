import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAppStore = defineStore('app', () => {
    const currentRoute = ref(route().current())

    document.addEventListener('inertia:navigate', () => {
        currentRoute.value = route().current()
    })

    return {
        currentRoute,
    }
})
