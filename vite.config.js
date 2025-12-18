import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true, // auto-refresh on changes
    }),
    tailwindcss(),
  ],
  build: {
    outDir: 'public/build', // Laravel Vite default
    emptyOutDir: true,      // clears old files before build
  },
});
