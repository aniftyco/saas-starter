import type { Payload as SendPasswordReset } from '@app/Jobs/SendPasswordResetJob';

declare module '@ioc:Rlanz/Queue' {
  interface JobsList {
    '@app/Jobs/SendPasswordResetJob': SendPasswordReset;
  }
}
