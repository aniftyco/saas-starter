import User from '@app/Models/User';
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

  public async forgotPassword({}: HttpContextContract) {
    throw new Error('@todo: Implement handler');
  }

  public async resetPassword({}: HttpContextContract) {
    throw new Error('@todo: Implement handler');
  }
}
