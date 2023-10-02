import clsx from 'clsx';
import { addCollection, edgeIconify } from 'edge-iconify';
import { twMerge } from 'tailwind-merge';

import { icons as tablerIcons } from '@iconify-json/tabler';

import type { ApplicationContract } from '@ioc:Adonis/Core/Application';

export default class AppProvider {
  constructor(protected app: ApplicationContract) {}

  public register() {
    // Register your own bindings
  }

  public async boot() {
    // IoC container is ready
  }

  public async ready() {
    // App is ready
    const View = this.app.container.use('Adonis/Core/View');

    addCollection(tablerIcons);
    View.use(edgeIconify);

    View.global('clsx', (...args: any[]) => {
      return twMerge(clsx(...args));
    });
  }

  public async shutdown() {
    // Cleanup, since app is going down
  }
}
