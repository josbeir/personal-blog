<?php

/**
 * @var Glaze\Config\SiteConfig $site
 * @var Glaze\Content\ContentPage $page
 * @var Glaze\Template\SiteContext $this
 */
?>
<s-template s:extends="layout/base">

<title s:prepend="title"><?= $page->title ?></title>

<s-template s:block="content">
    <?php
    $highlights = (array)$page->meta('hero.highlights', []);
    $projects = (array)$page->meta('projects.items', []);
    $posts = $this->type('post')->byDate('desc')->take((int)$page->meta('recentPosts.limit', 9));
    ?>

    <section class="relative left-1/2 w-screen -translate-x-1/2 -mt-27 mb-16 pt-16 border-b-2 border-base-content/20 bg-base-200 overflow-hidden">
        <div class="hero-ambient" aria-hidden="true">
            <span class="hero-ambient-gradient"></span>
            <span class="hero-ambient-orb hero-ambient-orb-a"></span>
            <span class="hero-ambient-orb hero-ambient-orb-b"></span>
            <span class="hero-ambient-orb hero-ambient-orb-c"></span>
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-10 min-h-[calc(100svh-4rem)] flex flex-col justify-center pt-8 pb-10 lg:py-4">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center w-full">
            <div class="lg:col-span-12 p-2">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-8">
                    <div class="max-w-4xl order-2 lg:order-1 relatvie z-50">
                        <p class="text-xs uppercase tracking-[0.2em] text-primary mb-3">Who I am</p>
                        <h1 class="text-5xl md:text-6xl xl:text-7xl font-black uppercase leading-[0.9] tracking-tight mb-6"><?= $site->title ?></h1>
                        <p class="text-xl text-base-content/85 mb-6"><?= $site->meta('hero.description', $site->description ?? '') ?></p>
                        <div class="flex flex-wrap gap-2 text-xs uppercase tracking-wider">
                            <a href="https://github.com/josbeir/" class="btn btn-ghost btn-xs" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4" aria-hidden="true">
                                    <path d="M12 2C6.48 2 2 6.58 2 12.23c0 4.52 2.87 8.35 6.84 9.7.5.1.66-.22.66-.5 0-.24-.01-.88-.01-1.73-2.78.62-3.37-1.38-3.37-1.38-.45-1.18-1.11-1.5-1.11-1.5-.91-.64.07-.63.07-.63 1 .08 1.53 1.06 1.53 1.06.9 1.57 2.36 1.12 2.94.86.09-.67.35-1.12.64-1.38-2.22-.26-4.56-1.14-4.56-5.06 0-1.12.39-2.03 1.03-2.74-.1-.26-.45-1.31.1-2.72 0 0 .84-.27 2.75 1.05A9.36 9.36 0 0 1 12 7.16c.85 0 1.7.12 2.5.36 1.9-1.32 2.74-1.05 2.74-1.05.55 1.41.2 2.46.1 2.72.64.71 1.03 1.62 1.03 2.74 0 3.93-2.34 4.8-4.57 5.06.36.31.68.92.68 1.86 0 1.34-.01 2.42-.01 2.75 0 .27.17.6.67.5A10.26 10.26 0 0 0 22 12.23C22 6.58 17.52 2 12 2z"/>
                                </svg>
                                GitHub
                            </a>
                            <a href="https://www.linkedin.com/in/jaspersmet/" class="btn btn-ghost btn-xs" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4" aria-hidden="true">
                                    <path d="M6.94 8.5a1.72 1.72 0 1 0 0-3.44 1.72 1.72 0 0 0 0 3.44ZM5.5 9.7h2.9V19H5.5V9.7Zm4.7 0h2.78v1.27h.04c.39-.73 1.34-1.5 2.75-1.5 2.94 0 3.48 1.95 3.48 4.48V19h-2.9v-4.49c0-1.07-.02-2.45-1.49-2.45-1.5 0-1.73 1.17-1.73 2.37V19h-2.9V9.7Z"/>
                                </svg>
                                LinkedIn
                            </a>
                            <a href="https://www.drupal.org/u/j0sbeir" class="btn btn-ghost btn-xs" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4 w-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 3c2.8 3.2 5 5 5 8a5 5 0 0 1-10 0c0-3 2.2-4.8 5-8z"></path>
                                    <path d="M8 13a4 4 0 0 0 8 0"></path>
                                </svg>
                                Drupal
                            </a>
                        </div>
                    </div>

                    <div class="avatar shrink-0 mx-auto lg:mx-0 order-1 lg:order-2" s:if="!empty($site->meta('hero.avatar'))">
                        <div class="w-64 sm:w-72 lg:w-80 rounded-box overflow-hidden border-2 border-base-content/20">
                            <img
                                src="<?= $this->url('/' . ltrim((string)$site->meta('hero.avatar'), '/')) ?>"
                                alt="<?= $site->meta('hero.title', $site->title) ?>"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="hero-highlights" class="mt-6 lg:mt-8 w-full" s:if="!empty($highlights)">
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <article class="card bg-base-100 border-2 border-base-content/20 transition-all highlight-card" style="--highlight-index: <?= (int)$index ?>; opacity: 0; transform: translateY(12px);" s:foreach="$highlights as $index => $item">
                    <div class="card-body">
                        <?php $iconKey = (string)($item['icon'] ?? ''); ?>
                        <div class="w-14 h-14 flex items-center justify-center mb-3" s:switch="$iconKey">
                            <svg s:case="'architecture'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="feature-card-icon h-8 w-8" stroke="#111111" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="10" width="6" height="10" rx="1"></rect>
                                <rect x="15" y="6" width="6" height="14" rx="1"></rect>
                                <path d="M9 15h6"></path>
                            </svg>
                            <svg s:case="'cakephp'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="feature-card-icon h-8 w-8" stroke="#111111" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M4 12h16v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"></path>
                                <path d="M8 12a2 2 0 1 1 4 0"></path>
                                <path d="M14 12a2 2 0 1 1 4 0"></path>
                                <path d="M7 9h10"></path>
                            </svg>
                            <svg s:case="'opensource'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="feature-card-icon h-8 w-8" stroke="#111111" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M3 12h18"></path>
                                <path d="M12 3a14 14 0 0 1 0 18"></path>
                                <path d="M12 3a14 14 0 0 0 0 18"></path>
                            </svg>
                            <svg s:case="'drupal'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="feature-card-icon h-8 w-8" stroke="#111111" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 3c2.8 3.2 5 5 5 8a5 5 0 0 1-10 0c0-3 2.2-4.8 5-8z"></path>
                                <path d="M8 13a4 4 0 0 0 8 0"></path>
                            </svg>
                            <svg s:default xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="feature-card-icon h-8 w-8" stroke="#111111" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M12 8v8"></path>
                                <path d="M8 12h8"></path>
                            </svg>
                        </div>
                        <h3 class="card-title"><?= $item['title'] ?? 'Highlight' ?></h3>
                        <p class="text-base-content/80"><?= $item['description'] ?? '' ?></p>
                    </div>
                </article>
            </div>
        </div>

        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 bottom-8 items-center gap-2 text-xs uppercase tracking-[0.18em] text-base-content/60" aria-hidden="true">
            <span>More below</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-4 w-4 animate-bounce" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M6 9l6 6 6-6"></path>
            </svg>
        </div>
        </div>
    </section>

    <section class="mb-10" s:notempty="$projects">
        <h2 class="text-3xl mb-6"><?= $page->meta('projects.title', 'Featured projects') ?></h2>
        <div class="grid gap-6 md:grid-cols-2">
            <article class="card relative overflow-visible bg-base-300 border border-base-content/10 hover:border-primary/40 transition-all" s:foreach="$projects as $project">
                <div class="card-body gap-4 pt-14">
                    <div class="absolute -top-12 right-4 w-24 h-24 flex items-center justify-center" s:if="!empty($project['logo'])">
                        <img
                            src="<?= $this->url((string)$project['logo']) ?>"
                            alt="<?= ($project['title'] ?? 'Project') . ' logo' ?>"
                            class="max-h-22 max-w-full object-contain"
                            loading="lazy"
                        />
                    </div>
                    <div class="absolute -top-8 right-5 text-3xl leading-none" s:if="empty($project['logo'])">
                        🚀
                    </div>

                    <div>
                        <h3 class="card-title leading-tight"><?= $project['title'] ?? 'Project' ?></h3>
                        <p class="text-xs uppercase tracking-wider text-base-content/50">Open source project</p>
                    </div>

                    <p class="text-base-content/80 leading-relaxed min-h-17"><?= $project['description'] ?? '' ?></p>

                    <div class="card-actions justify-end" s:if="!empty($project['href'])">
                        <a
                            href="<?= (string)$project['href'] ?>"
                            class="btn btn-outline btn-primary"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <?= $project['label'] ?? 'View project' ?>
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <h2 id="recent-posts" class="mb-8 text-3xl"><?= $page->meta('recentPosts.title', 'Recent posts') ?></h2>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-15">
        <article class="card bg-base-300 border border-base-content/10 hover:border-primary/35 transition-all overflow-hidden h-full" s:foreach="$posts as $post">
            <?php $image = $post->meta('images.0'); ?>
            <a s:if="$image" href="<?= $this->url($post->urlPath) ?>" class="block">
                <img loading="lazy" class="w-full aspect-video object-cover" src="<?= $this->url($post->urlPath . ltrim((string)$image, '/')) ?>" alt="<?= $post->title ?> Teaser Image" />
            </a>
            <div s:if="empty($image)" class="w-full aspect-video bg-base-200 border-b border-base-content/10"></div>
            <div class="card-body">
                <div class="content flex-1">
                    <h3 class="text-2xl leading-tight mb-2"><a class="hover:text-primary transition-colors" href="<?= $this->url($post->urlPath) ?>"><?= $post->title ?></a></h3>
                    <p class="text-sm text-base-content/60 mb-3" s:if="$post->meta('date') instanceof \Cake\Chronos\Chronos">
                        <?= $post->meta('date')->format('F j, Y') ?>
                    </p>
                    <p class="text-base-content/80"><?= mb_substr(strip_tags((string)$post->meta('description', '')), 0, 180) ?></p>
                </div>
                <div class="card-actions mt-4 justify-end">
                    <a class="btn btn-outline btn-primary btn-md" href="<?= $this->url($post->urlPath) ?>"><?= $page->meta('recentPosts.ctaLabel', 'View post') ?></a>
                </div>
            </div>
        </article>
    </div>

    <div class="flex justify-center mb-16">
        <a href="<?= $this->url('/posts/') ?>" class="btn btn-primary btn-outline">All posts</a>
    </div>
</s-template>
