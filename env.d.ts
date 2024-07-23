import { AxiosStatic } from 'axios';

declare global {
  // globals
  const axios: AxiosStatic;

  // extend to window
  interface Window {
    axios: typeof axios;
  }
}
