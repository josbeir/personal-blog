import { defineConfig } from 'astro/config';
import mdx from '@astrojs/mdx';
import sitemap from '@astrojs/sitemap';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  site: 'https://www.jaspersmet.be',

  i18n: {
    defaultLocale: 'en',
    locales: ['en', 'nl', 'fr'],
    routing: {
      prefixDefaultLocale: true,
    },
  },

  integrations: [mdx(), sitemap()],

  vite: {
    plugins: [tailwindcss()],
  },

  markdown: {
    syntaxHighlight: 'shiki',
  },
});
