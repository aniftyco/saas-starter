import SendPasswordResetJob from '@app/Jobs/SendPasswordResetJob';
import PasswordReset from '@app/Models/PasswordReset';
import User from '@app/Models/User';
import ForgotPasswordValidator from '@app/Validators/ForgotPasswordValidator';
import { string } from '@ioc:Adonis/Core/Helpers';
import Route from '@ioc:Adonis/Core/Route';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class ForgotPasswordController {
  public async index({ view, request }: HttpContextContract) {
    const { returnUrl = Route.makeUrl('dashboard') } = request.qs();

    return view.render('pages/auth/forgot-password', { returnUrl });
  }

  public async store({ request, response, session }: HttpContextContract) {
    const { email } = await request.validate(ForgotPasswordValidator);

    const user = await User.findByOrFail('email', email);

    await PasswordReset.query().where('user_id', user.id).delete();

    const { token } = await PasswordReset.create({ userId: user.id, token: string.generateRandom(32) });

    const url = Route.builder()
      .prefixUrl(new URL(request.completeUrl()).origin)
      .params({ token })
      .makeSigned('reset-password', { expiresIn: '12hr' });

    await SendPasswordResetJob.dispatch({ user, url });

    session.flash('success', 'A password reset email has been sent. Please check your email.');

    return response.redirect().back();
  }
}
