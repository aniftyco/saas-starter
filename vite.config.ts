import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import tsconfigPaths from 'vite-tsconfig-paths';

export default defineConfig({
  build: {
    outDir: 'public',
    emptyOutDir: false,
    manifest: 'assets/manifest.json',
  },
  plugins: [
    tsconfigPaths(),
    laravel({
      input: ['resources/client/tailwind.css', 'resources/client/app.tsx', 'resources/client/landing.ts'],
      refresh: true,
    }),
    tailwindcss(),
    react(),
  ],
});
