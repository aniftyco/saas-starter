import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';
import { DateTime } from 'luxon';

export default class SignOutController {
  public async handle({ auth, response, session }: HttpContextContract) {
    await auth.user!.related('sessions').query().where('id', session.sessionId).update({ deletedAt: DateTime.now() });
    await auth.logout();

    return response.redirect().toRoute('sign-in');
  }
}
