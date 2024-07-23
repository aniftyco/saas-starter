import type { Config } from 'tailwindcss';
import colors from 'tailwindcss/colors';
import animate from 'tailwindcss-animate';

export default {
  darkMode: ['class'],
  content: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/client/**/*.{ts,vue}'],
  theme: {
    extend: {
      colors: {
        primary: colors.indigo,
      },
      keyframes: {
        'accordion-down': {
          from: { height: '0' },
          to: { height: 'var(--radix-accordion-content-height)' },
        },
        'accordion-up': {
          from: { height: 'var(--radix-accordion-content-height)' },
          to: { height: '0' },
        },
      },
      animation: {
        'accordion-down': 'accordion-down 0.2s ease-out',
        'accordion-up': 'accordion-up 0.2s ease-out',
      },
    },
  },
  plugins: [animate],
} satisfies Config;
