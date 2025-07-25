import { AxiosStatic } from 'axios';
import { Livewire as LivewireInstance, Alpine as AlpineInstance } from '@vendor/livewire/livewire/dist/livewire.esm';

declare global {
  // globals
  const axios: AxiosStatic;
  const Livewire: typeof LivewireInstance;
  const Alpine: typeof AlpineInstance;

  // extend to window
  interface Window {
    axios: AxiosStatic;
    Livewire: typeof LivewireInstance;
    Alpine: typeof AlpineInstance;
    toggleTheme: <Theme = 'light' | 'dark' | 'auto'>(theme: Theme) => void;
  }
}
