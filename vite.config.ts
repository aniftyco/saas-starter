import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    outDir: 'public',
    emptyOutDir: false,
    manifest: 'assets/manifest.json',
  },
  server: {
    cors: true,
    watch: {
      ignored: ['**/storage/framework/views/**'],
    },
  },
  plugins: [
    tailwindcss(),
    laravel({
      input: ['resources/client/tailwind.css', 'resources/client/app.ts'],
      refresh: true,
    }),
  ],
});
