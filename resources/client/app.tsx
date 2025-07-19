import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import axios from 'axios';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import.meta.glob(['../images/**']);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./pages/${name}.tsx`, import.meta.glob('./pages/**/*.tsx')),
  setup: ({ el, App, props }) => void createRoot(el).render(<App {...props} />),
  progress: { color: '#4B5563' },
});
