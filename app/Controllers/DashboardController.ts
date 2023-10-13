import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

export default class DashboardController {
  public async handle({ view }: HttpContextContract) {
    return view.render('pages/dashboard');
  }
}
