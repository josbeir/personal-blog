<?php
    $image = $post->meta('images.0');
?>
<article class="card bg-base-300 border border-base-content/10 hover:border-primary/35 transition-all overflow-hidden h-full">
    <a s:if="$image" href="<?= $this->url($post->urlPath) ?>" class="block">
        <img
            loading="lazy"
            class="w-full aspect-video object-cover"
            src="<?= $this->url($post->urlPath . ltrim((string)$image, '/')) ?>"
            alt="<?= $post->title ?> Teaser Image"
        />
    </a>
    <div class="card-body">
        <div class="content flex-1">
            <h3 class="text-2xl leading-tight mb-2"><a class="hover:text-primary transition-colors" href="<?= $this->url($post->urlPath) ?>"><?= $post->title ?></a></h3>
            <p class="text-sm text-base-content/60 mb-3" s:if="$post->meta('date') instanceof \Cake\Chronos\Chronos">
                <?= $post->meta('date')->format('F j, Y') ?>
            </p>
            <p class="text-base-content/80">
                <?= mb_substr(strip_tags((string)$post->meta('description', '')), 0, 180) ?>
            </p>
        </div>
        <div class="card-actions mt-4 justify-end">
            <a class="btn btn-outline btn-primary btn-md" href="<?= $this->url($post->urlPath) ?>">
                <?= $page->meta('recentPosts.ctaLabel', 'View post') ?>
            </a>
        </div>
    </div>
</article>
