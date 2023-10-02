import type { Config } from 'tailwindcss';
import plugin from 'tailwindcss/plugin';

const config: Config = {
  content: ['./resources/views/**/*'],
  plugins: [
    require('@tailwindcss/forms'),
    plugin(({ addVariant }) => {
      addVariant('htmx-settling', ['&.htmx-settling', '.htmx-settling &']);
      addVariant('htmx-loading', ['&.htmx-request', '.htmx-request &']);
      addVariant('htmx-swapping', ['&.htmx-swapping', '.htmx-swapping &']);
      addVariant('htmx-added', ['&.htmx-added', '.htmx-added &']);
    }),
  ],
  theme: {},
};

export default config;
