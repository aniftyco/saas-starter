import SendPasswordResetJob from '@app/Jobs/SendPasswordResetJob';
import User from '@app/Models/User';
import ForgotPasswordValidator from '@app/Validators/ForgotPasswordValidator';
import ResetPasswordValidator from '@app/Validators/ResetPasswordValidator';
import SignInValidator from '@app/Validators/SignInValidator';
import SignUpValidator from '@app/Validators/SignUpValidator';
import Logger from '@ioc:Adonis/Core/Logger';

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
    await new Promise((r) => setTimeout(r, 1000));
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

    await SendPasswordResetJob.dispatch({ email }, { delay: 3000 });

    session.flash('success', 'A password reset email has been sent. Please check your email.');

    return response.redirect().back();
  }

  public async resetPassword({ request }: HttpContextContract) {
    const { password } = await request.validate(ResetPasswordValidator);

    console.log({ password });
  }
}
