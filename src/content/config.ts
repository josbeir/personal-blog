import { defineCollection, z } from 'astro:content';

const blog = defineCollection({
  type: 'content',
  schema: ({ image }) =>
    z.object({
      title: z.string(),
      description: z.string(),
      date: z.date(),
      tags: z.array(z.string()).default([]),
      draft: z.boolean().default(false),
      image: image().optional(),
    }),
});

const projects = defineCollection({
  type: 'data',
  schema: z.object({
    title: z.string(),
    href: z.string().url(),
    logo: z.string(),
    featured: z.boolean().default(false),
    order: z.number().default(0),
  }),
});

export const collections = { blog, projects };
