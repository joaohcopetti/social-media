import 'tippy.js/dist/tippy.css'
import 'vue-toast-notification/dist/theme-default.css'
import '../css/app.css'
import './bootstrap'

import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import { createApp, defineAsyncComponent, DefineComponent, h } from 'vue'
import ToastPlugin from 'vue-toast-notification'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

const MainLayout = defineAsyncComponent(() => import('./pages/main/_layouts/MainLayout.vue'))
const PanelLayout = defineAsyncComponent(() => import('./pages/panel/_layouts/PanelLayout.vue'))

createInertiaApp({
    title: (title) => title,
    resolve: async (name) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue')
        const page = await pages[`./pages/${name}.vue`]()

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
            // .use(VueTippy)
            .mount(el)
    },
    progress: {
        color: '#3498db',
    },
})
