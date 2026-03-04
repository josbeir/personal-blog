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
    <header class="mb-10 text-center">
        <h1 class="text-3xl lg:text-4xl mb-1 font-bold max-w-xl mx-auto"><?= $page->title ?></h1>
    </header>

    <article>
        <div class="prose lg:prose-xl mx-auto mb-8">
            <?= $content |> raw() ?>
        </div>

        <form action="https://formspree.io/f/mkndvanz" method="POST" class="block mx-auto bg-base-200 p-8 rounded-xl xl:max-w-2/3">
            <input type="text" name="_gotcha" style="display:none" />

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Your email</legend>
                <input type="email" name="email" class="input input-lg w-full validator" placeholder="my@email.com" required>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Name</legend>
                <input type="text" name="name" class="input input-lg w-full validator" placeholder="Your name" required>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Company name</legend>
                <input type="text" name="company" class="input input-lg w-full validator" placeholder="Company name" required>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Phone</legend>
                <input type="text" name="phone" class="input input-lg w-full validator" placeholder="Phone number" required>
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Your message</legend>
                <textarea name="message" placeholder="Hi there!" class="textarea textarea-lg w-full validator" rows="5" required></textarea>
            </fieldset>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Contact me</button>
            </div>
        </form>
    </article>
</s-template>
