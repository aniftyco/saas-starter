import SendPasswordResetJob from '@app/Jobs/SendPasswordResetJob';
import PasswordReset from '@app/Models/PasswordReset';
import User from '@app/Models/User';
import ForgotPasswordValidator from '@app/Validators/ForgotPasswordValidator';
import ResetPasswordValidator from '@app/Validators/ResetPasswordValidator';
import SignInValidator from '@app/Validators/SignInValidator';
import SignUpValidator from '@app/Validators/SignUpValidator';
import { string } from '@ioc:Adonis/Core/Helpers';
import Logger from '@ioc:Adonis/Core/Logger';
import Route from '@ioc:Adonis/Core/Route';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';
export default class AuthController {
  public async signUp({ request, response, auth, session }: HttpContextContract) {
    const { name, email, password } = await request.validate(SignUpValidator);

    try {
      const user = await User.create({ name, email, password });

      auth.login(user);

      return response.redirect().toRoute('dashboard');
    } catch (err: any) {
      Logger.error(err);

      session.flash('errors.email', 'Something went wrong');

      return response.redirect().back();
    }
  }

  public async signIn({ request, response, auth, session }: HttpContextContract) {
    const { email, password, remember } = await request.validate(SignInValidator);

    try {
      await auth.attempt(email, password, remember);

      return response.redirect().toRoute('dashboard');
    } catch (err: any) {
      Logger.error(err);

      session.flash('errors.email', 'Invalid credentials');

      return response.redirect().back();
    }
  }

  public async signOut({ auth, response }: HttpContextContract) {
    await auth.logout();

    return response.redirect().toRoute('sign-in');
  }

  public async forgotPassword({ request, session, response }: HttpContextContract) {
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

  public async renderResetForm({ params, view }: HttpContextContract) {
    return view.render('pages/reset-password', { token: params.token });
  }

  public async resetPassword({ request, params, session, response }: HttpContextContract) {
    const { password } = await request.validate(ResetPasswordValidator);
    const reset = await PasswordReset.query().where('token', params.token).preload('user').firstOrFail();

    reset.user.password = password;

    await reset.user.save();

    await reset.delete();

    session.flash('success', 'Your password has been reset. Please sign in.');

    return response.redirect().back();
  }
}
