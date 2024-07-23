import { AxiosStatic } from 'axios';

type RouteFn = <Params = number | string | number[] | string[] | Record<string, number | string>>(
  name: string,
  params?: Params
) => string;

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
