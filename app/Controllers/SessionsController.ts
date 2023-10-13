import Session from '@app/Models/Session';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class SessionsController {
  public async destroy({ session: currentSession, auth, params, response }: HttpContextContract) {
    if (params.sessionId) {
      const session = await Session.findOrFail(params.sessionId);

      await session.delete();
    } else {
      const session = await Session.findOrFail(currentSession.sessionId);

      await session.delete();

      await auth.logout();
    }

    return response.redirect().back();
  }
}
