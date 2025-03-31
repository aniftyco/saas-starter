import type { Config } from 'tailwindcss';
import animate from 'tailwindcss-animate';
import forms from '@tailwindcss/forms';

export default {
  darkMode: ['variant', ['@media (prefers-color-scheme: dark) { &:not(.light *) }', '&:is(.dark *)']],
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.ts',
  ],
  plugins: [forms, animate],
} satisfies Config;
