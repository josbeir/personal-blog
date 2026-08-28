import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

const blog = defineCollection({
  loader: glob({
    base: './src/content/blog',
    pattern: '**/*.{md,mdx}',
    generateId: ({ entry }) => entry
      .replace(/\.(md|mdx)$/, '')
      .replace(/\/index$/, ''),
  }),
  schema: ({ image }) =>
    z.object({
      title: z.string(),
      description: z.string(),
      date: z.coerce.date(),
      tags: z.array(z.string()).default([]),
      draft: z.boolean().default(false),
      image: image().optional(),
    }),
});

const projects = defineCollection({
  loader: glob({
    base: './src/content/projects',
    pattern: '**/*.{yaml,yml}',
  }),
  schema: z.object({
    title: z.string(),
    href: z.url(),
    logo: z.string(),
    featured: z.boolean().default(false),
    order: z.number().default(0),
  }),
});

export const collections = { blog, projects };
