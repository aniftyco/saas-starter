import { createApp, DefineComponent, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createInertiaApp({
  resolve(name) {
    const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', { eager: true });

    return pages[`./pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });

    app.config.globalProperties.$route = route;
    app.config.globalProperties.route = route;

    app.use(plugin);
    app.mount(el);
  },
});
