import type { Config } from 'tailwindcss';

export default {
  content: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/client/**/*.vue'],
  theme: {
    extend: {},
  },
  plugins: [],
} satisfies Config;
