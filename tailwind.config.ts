import type { Config } from 'tailwindcss';
import colors from 'tailwindcss/colors';
import animate from 'tailwindcss-animate';
import forms from '@tailwindcss/forms';

export default {
  darkMode: ['variant', [
    '@media (prefers-color-scheme: dark) { &:not(.light *) }',
    '&:is(.dark *)',
  ]],
  content: [
    './resources/client/**/*.vue',
    './resources/maizzle/**/*.html',
    './resources/views/**/*.blade.php',
    './storage/framework/views/*.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: colors.indigo,
        secondary: colors.zinc,

        background: colors.slate,

        danger: colors.red,
        warning: colors.yellow,
        success: colors.green,
        info: colors.blue,

      },
    },
  },
  plugins: [animate, forms],
} satisfies Config;
