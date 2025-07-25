import axios from 'axios';
import { Livewire, Alpine } from '@vendor/livewire/livewire/dist/livewire.esm';

window.Livewire = Livewire;
window.Alpine = Alpine;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Livewire.start();

document.addEventListener('DOMContentLoaded', () => {
  const THEMES = ['light', 'dark', 'auto'] as const;

  const getTheme = () => localStorage.getItem(import.meta.env.VITE_APP_THEME_KEY) || 'auto';

  const applyTheme = (theme: any) => {
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    document.documentElement.setAttribute('data-theme', theme === 'auto' ? (prefersDark ? 'dark' : 'light') : theme);
  };

  window.toggleTheme = (theme: any): string => {
    if (theme && THEMES.includes(theme)) {
      localStorage.setItem(import.meta.env.VITE_APP_THEME_KEY, theme);
      applyTheme(theme);
      return theme;
    } else {
      const currentTheme = getTheme();
      const nextIndex = (THEMES.indexOf(currentTheme as any) + 1) % THEMES.length;
      const newTheme = THEMES[nextIndex];

      localStorage.setItem(import.meta.env.VITE_APP_THEME_KEY, newTheme);
      applyTheme(newTheme);
      return newTheme;
    }
  };

  applyTheme(getTheme());

  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (getTheme() === 'auto') {
      applyTheme('auto');
    }
  });

  document.body.removeAttribute('x-cloak');
});
