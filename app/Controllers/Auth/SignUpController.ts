import User from '@app/Models/User';
import SignUpValidator from '@app/Validators/SignUpValidator';
import Logger from '@ioc:Adonis/Core/Logger';

import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class SignUpController {
  public async index({ view }: HttpContextContract) {
    return view.render('pages/auth/sign-up');
  }

  public async store({ request, response, auth, session }: HttpContextContract) {
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
}
