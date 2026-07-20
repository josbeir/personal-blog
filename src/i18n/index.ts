export const locales = ['en', 'nl', 'fr'] as const;

import { en } from './en';
import { nl } from './nl';
import { fr } from './fr';

const translations = { en, nl, fr };

type RecursiveRecord = {
  [key: string]: RecursiveRecord | string;
};

export function t(locale: string, key: string, params?: Record<string, string>): string {
  const dict = translations[locale as keyof typeof translations] ?? translations.en;
  const keys = key.split('.');
  let value: unknown = dict;
  for (const k of keys) {
    value = (value as RecursiveRecord)?.[k];
  }
  let result = (value as string) ?? key;
  if (params) {
    for (const [paramKey, paramValue] of Object.entries(params)) {
      result = result.replace(`{${paramKey}}`, paramValue);
    }
  }
  return result;
}

export function getSiteData(locale: string) {
  const prefix = `/${locale}`;
  return {
    description: t(locale, 'site.description'),
    hero: {
      title: t(locale, 'site.hero.title'),
      subtitle: t(locale, 'site.hero.subtitle'),
      description: t(locale, 'site.hero.description'),
      avatar: 'avatar.webp',
    },
    nav: [
      { label: t(locale, 'nav.home'), url: `${prefix}/` },
      { label: t(locale, 'nav.posts'), url: `${prefix}/posts/` },
      { label: t(locale, 'nav.contact'), url: `${prefix}/contact/` },
    ],
  };
}

export function getHomepageHighlights(locale: string) {
  return [
    {
      icon: 'cakephp',
      title: t(locale, 'highlights.cakephp.title'),
      description: t(locale, 'highlights.cakephp.description'),
    },
    {
      icon: 'opensource',
      title: t(locale, 'highlights.opensource.title'),
      description: t(locale, 'highlights.opensource.description'),
    },
    {
      icon: 'drupal',
      title: t(locale, 'highlights.drupal.title'),
      description: t(locale, 'highlights.drupal.description'),
    },
  ];
}

export async function getProjects(locale: string) {
  const { getCollection } = await import('astro:content');
  const entries = await getCollection('projects');
  entries.sort((a, b) => a.data.order - b.data.order);
  return entries.map((entry) => ({
    title: entry.data.title,
    description: t(locale, `projects.${entry.id}.description`),
    label: t(locale, `projects.${entry.id}.label`),
    href: entry.data.href,
    logo: entry.data.logo,
  }));
}

/** Subset of projects flagged as featured, for the homepage. */
export async function getFeaturedProjects(locale: string) {
  const { getCollection } = await import('astro:content');
  const entries = await getCollection('projects', ({ data }) => data.featured);
  entries.sort((a, b) => a.data.order - b.data.order);
  return entries.map((entry) => ({
    title: entry.data.title,
    description: t(locale, `projects.${entry.id}.description`),
    label: t(locale, `projects.${entry.id}.label`),
    href: entry.data.href,
    logo: entry.data.logo,
  }));
}

export function getHomepageIntro(locale: string) {
  return {
    title: t(locale, 'homepage.intro.title'),
    description: t(locale, 'homepage.intro.description'),
  };
}

export function getPostsPageData(locale: string) {
  return {
    title: t(locale, 'posts_page.title'),
    description: t(locale, 'posts_page.description'),
    intro: t(locale, 'posts_page.intro'),
  };
}

export function getContactPageData(locale: string) {
  return {
    title: t(locale, 'contact_page.title'),
    description: t(locale, 'contact_page.description'),
    intro: t(locale, 'contact_page.intro'),
  };
}

/** GetStaticPaths entries for pages that only vary by locale. */
export function localePaths() {
  return locales.map((locale) => ({ params: { locale } }));
}

/** GetStaticPaths entries for content pages that vary by locale and slug. */
export async function localeContentPaths<T extends { slug: string }>(
  getEntries: () => Promise<T[]>,
) {
  const entries = await getEntries();
  return locales.flatMap((locale) =>
    entries.map((entry) => ({
      params: { locale, slug: entry.slug },
      props: { entry },
    })),
  );
}
