# Repository Guidelines

## Project Structure & Module Organization

This is an Astro 7 personal site and blog. Application pages live in `src/pages/`, including localized routes under `src/pages/[locale]/`. Reusable UI belongs in `src/components/`, page shells in `src/layouts/`, and shared helpers in `src/lib/`.

Content is schema-validated in `src/content.config.ts`. Add blog posts as `src/content/blog/<slug>/index.mdx`, with images beside the post (for example, `teaser.png`). Add project cards as YAML files in `src/content/projects/`. Translation strings are in `src/i18n/`; global styles are in `src/styles/global.css`. Static files that do not need Astro image processing belong in `public/`.

## Build, Test, and Development Commands

- `npm run dev` (or `npm start`) starts the local Astro development server.
- `npm run build` validates content, type-checks through Astro, builds static routes, and optimizes imported images. Run it before handing off changes.
- `npm run preview` serves the built `dist/` output for a final local check.

The repository has no dedicated test or lint script. Treat a successful production build as the required baseline verification.

## Coding Style & Naming Conventions

Use TypeScript and Astro’s existing style: two-space indentation, semicolons, and single quotes in `.ts`/`.astro` files. Keep components in PascalCase (for example, `PostTeaser.astro`); use lowercase kebab-case for content slugs and asset names (for example, `ai-drupal-comfort-ddev-snapshot/`).

Do not use em dashes (Unicode U+2014) in user-facing copy, frontmatter, or code examples. Use a period, comma, colon, parentheses, or a rewritten sentence instead.

Blog frontmatter requires `title`, `description`, and `date`; use `tags`, `draft`, and `image` where appropriate. Import content images through `astro:assets` when they must be bundled into a page.

## Content, Localization & Accessibility

Keep posts concise and use descriptive alt text for meaningful images. Maintain the English source content first and update `nl`/`fr` translation strings or localized routes when the user-facing change requires it. Preserve the existing responsive Tailwind and DaisyUI utility patterns.

## Commit & Pull Request Guidelines

Recent history favors concise, scoped subjects such as `blog: add ddev snapshot blog` and `chore: update site info & content`. Follow that pattern: use a lowercase scope, colon, and imperative summary. Keep commits focused.

For pull requests, explain the visible change, note affected routes/content, link related issues when available, and include screenshots for layout or visual changes. State that `npm run build` passed; call out any expected external-data or network warnings.
