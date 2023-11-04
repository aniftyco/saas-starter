import type { Config } from 'tailwindcss';
import plugin from 'tailwindcss/plugin';

const config: Config = {
  content: ['./resources/views/**/*'],
  plugins: [
    require('@tailwindcss/forms'),
    require('tailwind-htmx'),
    plugin(({ addBase }) =>
      addBase({
        '[x-cloak]': { display: 'none !important' },
      })
    ),
  ],
  theme: {},
};

export default config;
