import { AxiosStatic } from 'axios';
import PusherStatic from 'pusher-js';
import EchoStatic from 'laravel-echo';

declare global {
  // globals
  const axios: AxiosStatic;
  const Pusher: typeof PusherStatic;
  const Echo: EchoStatic<any>;

  // extend to window
  interface Window {
    axios: AxiosStatic;
    Pusher: typeof PusherStatic;
    Echo: EchoStatic<any>;
  }
}
