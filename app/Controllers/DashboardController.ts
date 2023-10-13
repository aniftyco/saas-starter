import uaParser from 'ua-parser-js';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class DashboardController {
  public async handle({ auth, view, session, geolite2 }: HttpContextContract) {
    const sessions = (await auth.user!.related('sessions').query().whereNull('deletedAt'))
      .sort((a, b) => {
        if (a.id === session.sessionId) return -1;
        if (b.id === session.sessionId) return 1;
        return (b.createdAt.toJSDate() as any) - (a.createdAt.toJSDate() as any);
      })
      .map((session) => ({
        id: session.id,
        agent: uaParser(session.agent),
        ip: session.ip,
        geo: { country: geolite2.country(session.ip), city: geolite2.city(session.ip), asn: geolite2.asn(session.ip) },
        creaedAt: session.createdAt,
      }));

    return view.render('pages/dashboard', { sessionId: session.sessionId, sessions });
  }
}
