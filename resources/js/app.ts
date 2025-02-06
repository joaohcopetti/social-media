import '../css/app.css'

import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import { createApp, DefineComponent, h } from 'vue'
import ToastPlugin from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-default.css'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import './bootstrap'
import MainLayout from './layouts/MainLayout.vue'
import PanelLayout from './layouts/PanelLayout.vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: () => `${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', {
            eager: true,
        })

        const page = pages[`./pages/${name}.vue`]

        page.default.layout = name.includes('panel/') ? PanelLayout : MainLayout

        return page
    },
    setup({ el, App, props, plugin }) {
        const pinia = createPinia()

        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(autoAnimatePlugin)
            .use(pinia)
            .use(ToastPlugin)
            .mount(el)
    },
    progress: {
        color: '#4B5563',
    },
})
