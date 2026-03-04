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
    <h1 class="text-3xl mb-6"><?= $page->title ?></h1>
    <section class="mb-6 prose max-w-none">
        <?= $content |> raw() ?>
    </section>

    <div class="grid gap-6 md:grid-cols-2">
        <article class="card bg-base-300 border border-base-content/10 shadow-sm overflow-hidden h-full" s:foreach="$this->type('post')->byDate('desc') as $post">
            <?php $image = $post->meta('images.0'); ?>
            <a s:if="$image" href="<?= $this->url($post->urlPath) ?>" class="block">
                <img loading="lazy" class="w-full aspect-video object-cover" src="<?= $this->url($post->urlPath . ltrim((string)$image, '/')) ?>" alt="<?= $post->title ?> Teaser Image" />
            </a>
            <div s:if="empty($image)" class="w-full aspect-video bg-base-200 border-b border-base-content/10"></div>
            <div class="card-body">
                <div class="content flex-1">
                    <h2 class="text-2xl leading-tight mb-2"><a class="hover:text-primary transition-colors" href="<?= $this->url($post->urlPath) ?>"><?= $post->title ?></a></h2>
                    <p class="text-sm text-base-content/60 mb-3" s:if="$post->meta('date') instanceof \Cake\Chronos\Chronos">
                        <?= $post->meta('date')->format('F j, Y') ?>
                    </p>
                    <p class="text-base-content/80"><?= mb_substr(strip_tags((string)$post->meta('description', '')), 0, 180) ?></p>
                </div>
                <div class="card-actions mt-4 justify-end">
                    <a class="btn btn-outline btn-primary btn-md" href="<?= $this->url($post->urlPath) ?>">View post</a>
                </div>
            </div>
        </article>
    </div>
</s-template>
