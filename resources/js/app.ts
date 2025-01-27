import '../css/app.css'

import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import { createApp, DefineComponent, h } from 'vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import AdminLayout from './layouts/AdminLayout.vue'
import MainLayout from './layouts/MainLayout.vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: () => `${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', {
            eager: true,
        })

        const page = pages[`./pages/${name}.vue`]

        page.default.layout = name.includes('panel/') ? AdminLayout : MainLayout

        return page
    },
    setup({ el, App, props, plugin }) {
        const pinia = createPinia()

        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(autoAnimatePlugin)
            .use(pinia)
            .mount(el)
    },
    progress: {
        color: '#4B5563',
    },
})
