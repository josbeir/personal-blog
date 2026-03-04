<?php

/**
 * @var Glaze\Config\SiteConfig $site
 * @var Glaze\Content\ContentPage $page
 * @var Glaze\Template\SiteContext $this
 */
?>
<s-template s:extends="layout/base">

<title s:prepend="title"><?= $title ?> | </title>

<s-template s:block="content">
	<section class="prose lg:prose-xl mx-auto">
		<?= $content |> raw() ?>
	</section>
</s-template>
