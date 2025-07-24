import axios from 'axios';
import { Livewire, Alpine } from '@vendor/livewire/livewire/dist/livewire.esm';

window.Livewire = Livewire;
window.Alpine = Alpine;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Livewire.start();

document.addEventListener('DOMContentLoaded', () => {
  const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  document.documentElement.setAttribute('data-theme', prefersDark ? 'dark' : 'light');

  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
    document.documentElement.setAttribute('data-theme', event.matches ? 'dark' : 'light');
  });

  document.body.removeAttribute('x-cloak');
});
