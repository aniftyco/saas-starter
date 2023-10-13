import { DateTime } from 'luxon';

import PasswordReset from '@app/Models/PasswordReset';
import ResetPasswordValidator from '@app/Validators/ResetPasswordValidator';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';
export default class ResetPasswordController {
  public async index({ view, params }: HttpContextContract) {
    return view.render('pages/auth/reset-password', { token: params.token });
  }

  public async store({ request, response, params, session }: HttpContextContract) {
    const { password } = await request.validate(ResetPasswordValidator);
    const reset = await PasswordReset.query().where('token', params.token).preload('user').firstOrFail();

    reset.user.password = password;

    await reset.user.save();

    await reset.user
      .related('sessions')
      .query()
      .whereNull('deletedAt')
      .update({ updatedAt: DateTime.now(), deletedAt: DateTime.now() });

    await reset.delete();

    session.flash('success', 'Your password has been reset. Please sign in.');

    return response.redirect().back();
  }
}
