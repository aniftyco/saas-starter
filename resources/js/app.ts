import 'tailwindcss/tailwind.css';

import Htmx from 'htmx.org';

declare global {
  interface Window {
    Htmx: typeof Htmx;
  }
}

window.Htmx = Htmx;
