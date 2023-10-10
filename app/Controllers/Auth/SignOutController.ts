import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class SignOutController {
  public async handle({ auth, response }: HttpContextContract) {
    await auth.logout();

    return response.redirect().toRoute('sign-in');
  }
}
