import { createApp, DefineComponent, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import axios from 'axios';
import tailwind from '@root/tailwind.config';
import AppLayout from '@app/layouts/app.vue';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createInertiaApp({
  resolve(name) {
    const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', { eager: true });
    const page = pages[`./pages/${name}.vue`];

    page.default.layout = page.default.layout || AppLayout;

    return pages[`./pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });

    (route as any).is = (...args: any) => (route() as any).current(...args);

    app.config.globalProperties.$route = route;
    app.config.globalProperties.route = route;

    app.use(plugin);
    app.mount(el);
  },
  progress: {
    // Use our primary theme for progress bar
    color: tailwind.theme.extend.colors.primary[600],
  },
});
