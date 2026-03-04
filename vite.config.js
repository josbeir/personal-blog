import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [tailwindcss()],
  build: {
    outDir: 'public',
    manifest: true,
    emptyOutDir: false,
    rollupOptions: {
      input: [
        'assets/css/site.css',
        'assets/js/site.js',
      ],
    },
  },
});
