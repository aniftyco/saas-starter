import 'tailwindcss/tailwind.css';

import Alpine from 'alpinejs';
import htmx from 'htmx.org';

import anchor from '@alpinejs/anchor';

declare global {
  interface Window {
    htmx: typeof htmx;
    Alpine: typeof Alpine;
  }
}

window.htmx = htmx;
window.Alpine = Alpine;

Alpine.plugin(anchor);
Alpine.start();

require('htmx.org/dist/ext/head-support');
require('htmx-ext/dist/body-support');
require('htmx-ext/dist/csrf-token');
