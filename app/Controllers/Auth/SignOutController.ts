import Session from '@app/Models/Session';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';
export default class SignOutController {
  public async handle({ auth, response, session }: HttpContextContract) {
    const activeSession = await Session.find(session.sessionId);

    await activeSession!.delete();

    await auth.logout();

    return response.redirect().toRoute('sign-in');
  }
}
