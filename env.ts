/*
|--------------------------------------------------------------------------
| Validating Environment Variables
|--------------------------------------------------------------------------
|
| In this file we define the rules for validating environment variables.
| By performing validation we ensure that your application is running in
| a stable environment with correct configuration values.
|
| This file is read automatically by the framework during the boot lifecycle
| and hence do not rename or move this file to a different location.
|
*/

import Env from '@ioc:Adonis/Core/Env';

export default Env.rules({
  NODE_ENV: Env.schema.enum(['development', 'production', 'test'] as const),

  APP_NAME: Env.schema.string(),
  APP_KEY: Env.schema.string(),

  HOST: Env.schema.string({ format: 'host' }),
  PORT: Env.schema.number(),

  CACHE_VIEWS: Env.schema.boolean(),

  SESSION_DRIVER: Env.schema.enum.optional(['cookie', 'file', 'redis'] as const),
  SESSION_NAME: Env.schema.string.optional(),
  SESSION_REDIS_CONNECTION_NAME: Env.schema.enum.optional(['local'] as const),

  DRIVE_DISK: Env.schema.enum.optional(['local'] as const),

  DATABASE_CONNECTION: Env.schema.string.optional(),
  DATABASE_URL: Env.schema.string(),

  CORS_ENABLED: Env.schema.boolean.optional(),

  MAIL_TRANSPORT: Env.schema.enum.optional(['smtp', 'ses', 'mailgun'] as const),

  MAIL_HOST: Env.schema.string.optional(),
  MAIL_PORT: Env.schema.number.optional(),
  MAIL_USERNAME: Env.schema.string.optional(),
  MAIL_PASSWORD: Env.schema.string.optional(),

  SES_ACCESS_KEY: Env.schema.string.optional(),
  SES_ACCESS_SECRET: Env.schema.string.optional(),
  SES_REGION: Env.schema.string.optional(),

  MAILGUN_API_KEY: Env.schema.string.optional(),
  MAILGUN_DOMAIN: Env.schema.string.optional(),
});
