import { resolve } from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tsconfigPaths from 'vite-tsconfig-paths';
import vue from '@vitejs/plugin-vue';
import maizzle from 'vite-plugin-maizzle';
import tailwind from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
  css: {
    postcss: {
      plugins: [tailwind(), autoprefixer()],
    },
  },
  plugins: [
    tsconfigPaths(),
    vue(),
    laravel({
      input: ['resources/client/app.css', 'resources/client/app.ts'],
      refresh: true,
    }),
    maizzle({
      src: resolve(process.cwd(), 'resources/maizzle'),
      dest: resolve(process.cwd(), 'resources/views/mail'),
      ext: 'blade.php',
    }),
  ],
  resolve: {
    alias: {
      '@app': resolve(__dirname, 'resources/client'),
      '@vendor': resolve(__dirname, 'vendor/'),
    },
  },
});
