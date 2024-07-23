import type { Config } from 'tailwindcss';
import colors from 'tailwindcss/colors';

export default {
  content: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/client/**/*.vue'],
  theme: {
    extend: {
      colors: {
        primary: colors.indigo,
      },
    },
  },
  plugins: [],
} satisfies Config;
