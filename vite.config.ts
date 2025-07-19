import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/client/tailwind.css', 'resources/client/app.ts'],
      refresh: true,
    }),
    tailwindcss(),
    react(),
  ],
});
