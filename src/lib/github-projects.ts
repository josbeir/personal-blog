export interface GitHubProject {
  name: string;
  description: string | null;
  url: string;
  language: string | null;
  stars: number;
  forks: number;
  pushedAt: string;
}

interface GitHubRepositoryResponse {
  name: string;
  description: string | null;
  html_url: string;
  language: string | null;
  stargazers_count: number;
  forks_count: number;
  pushed_at: string | null;
  fork: boolean;
  archived: boolean;
}

const username = 'josbeir';
const githubToken = import.meta.env.GITHUB_TOKEN;
let projectsPromise: Promise<GitHubProject[]> | undefined;
// Add any repository name here to hide it from the site. Forks and archived
// repositories are always excluded, whether or not they are listed here.
const ignoredRepositories = new Set([
  'josbeir',
  'personal-blog',
  'cakephp-json-api',
  'cakephp-paginator-sortmap',
  'shopwedo-php-api',
  'cakephp-image',
  'zed-latte',
  'tree-sitter-latte',
]);

function sortByName(projects: GitHubProject[]) {
  return projects.sort((a, b) => a.name.localeCompare(b.name));
}

async function fetchGitHubProjects(): Promise<GitHubProject[]> {
  try {
    const response = await fetch(
      `https://api.github.com/users/${username}/repos?per_page=100&type=owner&sort=updated`,
      {
        headers: {
          Accept: 'application/vnd.github+json',
          'X-GitHub-Api-Version': '2022-11-28',
          ...(githubToken ? { Authorization: `Bearer ${githubToken}` } : {}),
        },
      },
    );

    if (!response.ok) {
      const remaining = response.headers.get('x-ratelimit-remaining');
      const reset = response.headers.get('x-ratelimit-reset');
      const resetAt = reset ? new Date(Number(reset) * 1000).toLocaleTimeString() : undefined;
      const rateLimitHint = remaining === '0' ? ` (rate limit resets at ${resetAt})` : '';
      throw new Error(`GitHub returned ${response.status}${rateLimitHint}`);
    }

    const repositories = (await response.json()) as GitHubRepositoryResponse[];
    return sortByName(
      repositories
        .filter((repository) => !repository.fork && !repository.archived && !ignoredRepositories.has(repository.name))
        .filter((repository) => repository.pushed_at)
        .map((repository) => ({
          name: repository.name,
          description: repository.description,
          url: repository.html_url,
          language: repository.language,
          stars: repository.stargazers_count,
          forks: repository.forks_count,
          pushedAt: repository.pushed_at!,
        })),
    );
  } catch (error) {
    console.warn('Unable to refresh GitHub projects.', error);
    return [];
  }
}

export function getGitHubProjects(): Promise<GitHubProject[]> {
  // The home page is built once per locale. Reuse the same request so a build
  // makes one API call rather than three.
  projectsPromise ??= fetchGitHubProjects();
  return projectsPromise;
}

export const githubProfileUrl = `https://github.com/${username}`;
