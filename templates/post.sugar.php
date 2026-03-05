<?php
use function Sugar\Core\Runtime\raw;

/**
 * @var Glaze\Config\SiteConfig $site
 * @var Glaze\Content\ContentPage $page
 * @var Glaze\Template\SiteContext $this
 */
?>
<s-template s:extends="layout/base">

<title s:prepend="title"><?= $page->title ?></title>

<s-template s:block="content">
    <header class="mb-10 text-center">
        <h1 class="text-2xl md:text-3xl lg:text-4xl mb-10 font-extrabold max-w-4xl mx-auto leading-snug tracking-tight"><?= $page->title ?></h1>

        <div class="divider mb-10 mt-6" s:if="$page->meta('date') instanceof \Cake\Chronos\Chronos">
            <time class="text-base-content/45" datetime="<?= $page->meta('date')->toIso8601String() ?>">
                <?= $page->meta('date')->format('F j, Y') ?>
            </time>
        </div>
    </header>

    <article class="prose lg:prose-xl mx-auto">
        <?= $content |> raw() ?>
    </article>

    <div class="mt-10 divider"></div>
    <section class="mt-8 xl:max-w-2/3 mx-auto">
        <script src="https://giscus.app/client.js"
            data-repo="josbeir/personal-blog"
            data-repo-id="R_kgDOLfQ6BA"
            data-category="Announcements"
            data-category-id="DIC_kwDOLfQ6BM4CwBmN"
            data-mapping="pathname"
            data-strict="0"
            data-reactions-enabled="1"
            data-emit-metadata="0"
            data-input-position="bottom"
            data-theme="preferred_color_scheme"
            data-lang="en"
            crossorigin="anonymous"
            async>
        </script>
    </section>
</s-template>
