const THEME_ATTR = 'data-theme';
const STORAGE_KEY = 'theme';

const THEMES = {
  light: 'spring-fun',
  dark: 'spring-night',
};

const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

function resolveMode() {
  const saved = localStorage.getItem(STORAGE_KEY);
  if (saved === 'light' || saved === 'dark') {
    return saved;
  }
  return mediaQuery.matches ? 'dark' : 'light';
}

function applyTheme(mode) {
  document.documentElement.setAttribute(THEME_ATTR, THEMES[mode]);
  const toggle = document.querySelector('[data-theme-toggle]');
  if (toggle instanceof HTMLInputElement) {
    toggle.checked = mode === 'dark';
  }
}

function initThemeToggle() {
  applyTheme(resolveMode());

  const toggle = document.querySelector('[data-theme-toggle]');
  if (toggle instanceof HTMLInputElement) {
    toggle.addEventListener('change', () => {
      const mode = toggle.checked ? 'dark' : 'light';
      localStorage.setItem(STORAGE_KEY, mode);
      applyTheme(mode);
    });
  }

  mediaQuery.addEventListener('change', () => {
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved !== 'light' && saved !== 'dark') {
      applyTheme(resolveMode());
    }
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initThemeToggle);
} else {
  initThemeToggle();
}
