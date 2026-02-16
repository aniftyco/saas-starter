import axios from 'axios';

import.meta.glob(['../images/**']);

declare global {
  interface Window {
    axios: typeof axios;
  }
}

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
