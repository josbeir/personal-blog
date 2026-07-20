const SITE = 'https://www.jaspersmet.be';

export async function GET() {
  const pages = [
    { url: '/', title: 'Jasper Smet', description: 'Freelance full stack developer focused on CakePHP, Drupal, and open source products.' },
    { url: '/contact/', title: "Let's talk", description: 'Get in touch with me through the contact form.' },
    { url: '/posts/', title: 'Posts', description: 'Discover insights on technology, creativity, and ideas.' },
    { url: '/nl/', title: 'Jasper Smet', description: 'Freelance full stack ontwikkelaar gespecialiseerd in CakePHP en Drupal.' },
    { url: '/nl/contact/', title: 'Laten we praten', description: 'Neem contact met mij op via het contactformulier.' },
    { url: '/nl/posts/', title: 'Berichten', description: 'Ontdek inzichten over technologie, creativiteit en ideeën.' },
    { url: '/fr/', title: 'Jasper Smet', description: 'Développeur full stack freelance spécialisé en CakePHP et Drupal.' },
    { url: '/fr/contact/', title: 'Parlons-en', description: 'Contactez-moi via le formulaire.' },
    { url: '/fr/posts/', title: 'Articles', description: "Découvrez des insights sur la technologie, la créativité et les idées." },
  ];

  const { getCollection } = await import('astro:content');
  const posts = await getCollection('blog');
  posts.sort((a, b) => b.data.date.valueOf() - a.data.date.valueOf());

  const postUrls = posts.map((post) => ({
    url: `/posts/${post.slug}/`,
    title: post.data.title,
    description: post.data.description,
  }));

  const allPages = [...pages, ...postUrls];

  const lines = [
    '# Jasper Smet',
    '',
    `> ${allPages.find((p) => p.url === '/')?.description ?? ''}`,
    '',
    ...allPages.filter((p) => p.url !== '/').flatMap((p) => (p.url.startsWith('/posts/') && p.url !== '/posts/' ? `- [${p.title}](${SITE}${p.url}): ${p.description}` : [])),
    '',
    '## Pages',
    ...allPages.filter((p) => !p.url.startsWith('/posts/') || p.url === '/posts/').map((p) => `- [${p.title}](${SITE}${p.url}): ${p.description}`),
  ];

  return new Response(lines.join('\n'), {
    headers: { 'Content-Type': 'text/plain; charset=utf-8' },
  });
}
