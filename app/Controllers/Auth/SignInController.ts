import SignInValidator from '@app/Validators/SignInValidator';
import Logger from '@ioc:Adonis/Core/Logger';
import Route from '@ioc:Adonis/Core/Route';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class AuthController {
  public async index({ view, request }: HttpContextContract) {
    const { returnUrl = Route.makeUrl('dashboard') } = request.qs();

    return view.render('pages/auth/sign-in', { returnUrl });
  }

  public async store({ request, response, auth, session }: HttpContextContract) {
    const { email, password, remember, returnUrl } = await request.validate(SignInValidator);

    try {
      await auth.attempt(email, password, remember);

      auth.user!.related('sessions').create({
        id: session.sessionId,
        ip: request.ip(),
        agent: request.header('user-agent'),
      });

      if (returnUrl) {
        return response.redirect().toPath(returnUrl);
      }
      return response.redirect().toRoute('dashboard');
    } catch (err: any) {
      Logger.error(err);

      session.flash('errors.email', 'Invalid credentials');

      return response.redirect().back();
    }
  }
}
