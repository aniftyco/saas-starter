import 'tailwindcss/tailwind.css';

import htmx from 'htmx.org';

declare global {
  interface Window {
    htmx: typeof htmx;
  }
}

window.htmx = htmx;

require('htmx.org/dist/ext/head-support');
require('htmx-ext/dist/body-support');
require('htmx-ext/dist/csrf-token');
