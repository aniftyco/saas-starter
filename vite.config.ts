import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tsconfigPaths from 'vite-tsconfig-paths';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    tsconfigPaths(),
    vue(),
    laravel({
      input: ['resources/client/app.css', 'resources/client/app.ts'],
      refresh: true,
    }),
  ],
});
