import rss from '@astrojs/rss';
import { getCollection } from 'astro:content';
import { getSiteData } from '../i18n/index';

const siteData = getSiteData('en');
const posts = await getCollection('blog');

posts.sort((a, b) => b.data.date.valueOf() - a.data.date.valueOf());

export const GET = () =>
  rss({
    title: 'Jasper Smet',
    description: siteData.description,
    site: 'https://www.jaspersmet.be',
    items: posts.map((post) => ({
      title: post.data.title,
      description: post.data.description,
      pubDate: post.data.date,
      link: `/posts/${post.slug}/`,
    })),
    customData: `<language>en-us</language>`,
  });
