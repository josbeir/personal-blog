<?php
/**
 * @var Glaze\Config\SiteConfig $site
 * @var Glaze\Content\ContentPage $page
 * @var Glaze\Template\SiteContext $this
 */
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title s:trim>
		<s-ifblock name="title">
			<s-template s:block="title" name="title" /> |
		</s-ifblock>
		<?= $site->title ?? 'Glaze static site generator' ?>
	</title>
	<s-template s:include="../partials/meta" />
	<link rel="icon" type="image/svg+xml" href="<?= $this->url('/favicon.svg') ?>">
	<link rel="shortcut icon" href="<?= $this->url('/favicon.svg') ?>">
    <link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
	<s-vite src="['assets/css/site.css', 'assets/js/site.js']" />
	<script async src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
</head>
<body class="min-h-screen bg-base-100 text-base-content">
<div class="drawer lg:drawer-open">
	<input id="mobile-nav-drawer" type="checkbox" class="drawer-toggle" />

	<div class="drawer-content flex flex-col min-h-screen">
		<header class="border-b border-primary/15 bg-base-100/90 backdrop-blur supports-backdrop-filter:bg-base-100/70 sticky top-0 z-30">
			<div class="navbar max-w-7xl mx-auto px-4 lg:px-8">
				<div class="navbar-start">
					<label for="mobile-nav-drawer" class="btn btn-ghost btn-square lg:hidden" aria-label="open menu">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-5 w-5 stroke-current">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
						</svg>
					</label>

					<a href="<?= $this->url('/') ?>" class="btn btn-ghost text-xl px-2">
						<span class="font-semibold"><?= $site->title ?></span>
					</a>
				</div>

				<div class="navbar-center hidden lg:flex">
					<ul class="menu menu-horizontal px-1 gap-1">
						<li s:foreach="$site->meta('nav', []) as $navItem" s:trim>
							<a href="<?= $this->url($navItem['url'] ?? '/') ?>" s:class="['active' => $this->isCurrent($navItem['url'] ?? '/')]">
								<?= $navItem['label'] ?? 'Nav item' ?>
							</a>
						</li>
					</ul>
				</div>

				<div class="navbar-end">
					<label class="swap swap-rotate btn btn-ghost btn-circle mr-1" aria-label="Toggle theme">
						<input type="checkbox" data-theme-toggle />
						<svg class="swap-on h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8" />
						</svg>
						<svg class="swap-off h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<circle cx="12" cy="12" r="4" />
							<path d="M12 2v2" />
							<path d="M12 20v2" />
							<path d="m4.93 4.93 1.41 1.41" />
							<path d="m17.66 17.66 1.41 1.41" />
							<path d="M2 12h2" />
							<path d="M20 12h2" />
							<path d="m6.34 17.66-1.41 1.41" />
							<path d="m19.07 4.93-1.41 1.41" />
						</svg>
					</label>
					<a href="<?= $this->url('/contact/') ?>" class="btn btn-primary btn-sm lg:btn-md">Get in touch</a>
				</div>
			</div>
		</header>

		<main class="max-w-7xl mx-auto p-6 lg:p-10 w-full" s:block="content">
			Default page content
		</main>

		<footer class="footer footer-center p-6 border-t border-base-content/10 text-base-content/70">
			<aside>
				<p>Copyright © <?= date('Y') ?> - All rights reserved</p>
			</aside>
		</footer>
	</div>

	<div class="drawer-side lg:hidden z-40">
		<label for="mobile-nav-drawer" class="drawer-overlay"></label>
		<ul class="menu p-4 w-72 min-h-full bg-base-100 text-base-content border-r border-base-content/10">
			<li s:foreach="$site->meta('nav', []) as $navItem" s:trim>
				<a href="<?= $this->url($navItem['url'] ?? '/') ?>" s:class="['active' => $this->isCurrent($navItem['url'] ?? '/')]">
					<?= $navItem['label'] ?? 'Nav item' ?>
				</a>
			</li>
		</ul>
	</div>
</div>
</body>
</html>
