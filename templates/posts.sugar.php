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

    <div class="grid gap-6 md:grid-cols-3">
        <s-template s:foreach="$this->type('post')->byDate('desc') as $post">
            <s-template
                s:include="partials/post-teaser"
                s:with="[
                    'post' => $post,
                    'page' => $page,
                ]"
            />
        </s-template>
    </div>
</s-template>
