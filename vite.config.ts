import { resolve } from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import tsconfigPaths from 'vite-tsconfig-paths';

export default defineConfig({
  plugins: [
    tailwindcss(),
    tsconfigPaths(),
    laravel({
      input: ['resources/client/tailwind.css', 'resources/client/app.ts'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@app': resolve(__dirname, 'resources/client'),
      '@vendor': resolve(__dirname, 'vendor/'),
    },
  },
});
