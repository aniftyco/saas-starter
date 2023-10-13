import { AuthenticationException } from '@adonisjs/auth/build/standalone';
import Route from '@ioc:Adonis/Core/Route';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class ValidateSession {
  /**
   * The named route to redirect to when session is invalid
   */
  protected redirectTo = 'sign-in';

  protected async validate({ auth, session, request }: HttpContextContract) {
    if (await auth.check()) {
      try {
        await auth
          .user!.related('sessions')
          .query()
          .where('id', session.sessionId)
          .whereNull('deleted_at')
          .firstOrFail();
      } catch (err: any) {
        await auth.logout();

        throw new AuthenticationException(
          'Invalid session',
          'E_INVALID_SESSION',
          undefined,
          Route.builder().qs({ returnUrl: request.url() }).make(this.redirectTo)
        );
      }
    }
  }

  /**
   * Handle request
   */
  public async handle({ auth, session, request }: HttpContextContract, next: () => Promise<void>) {
    await this.validate({ auth, session, request } as HttpContextContract);

    await next();
  }
}
