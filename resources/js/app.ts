import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import MainLayout from './layouts/MainLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', {
            eager: true,
        });

        const page = pages[`./pages/${name}.vue`];

        page.default.layout = page.default.layout || MainLayout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
