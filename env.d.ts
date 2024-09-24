import { AxiosStatic } from 'axios';

interface RouteFn {
    <Params = number | string | number[] | string[] | Record<string, number | string>>(
        name?: string,
        params?: Params
    ): string;

    is(name: string): boolean;
}

declare global {
  // globals
  const axios: AxiosStatic;
  const route: RouteFn;

  // extend to window
  interface Window {
    axios: typeof axios;
    route: typeof route;
  }
}

// Augment Vue
declare module 'vue' {
  interface ComponentCustomProperties {
    route: RouteFn;
    $route: RouteFn;
  }
}
