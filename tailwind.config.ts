import type { Config } from 'tailwindcss';

const config: Config = {
  content: ['./resources/views/**/*'],
  plugins: [require('@tailwindcss/forms')],
  theme: {},
};

export default config;
