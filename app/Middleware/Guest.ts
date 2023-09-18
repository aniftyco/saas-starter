import type { HttpContextContract } from '@ioc:Adonis/Core/HttpContext';

/**
 * Guest middleware is meant to restrict authenticated access to a given route
 * or a group of routes.
 *
 * You must register this middleware inside `start/kernel.ts` file under the list
 * of named middleware.
 */
export default class GuestMiddleware {
  /**
   * The named route to redirect to when request is not a guest
   */
  protected defaultRedirect = 'dashboard';

  /**
   * Handle request
   */
  public async handle({ response, auth }: HttpContextContract, next: () => Promise<void>, route: string) {
    /**
     * If user is authenticated then redirect them.
     */
    if (auth.isAuthenticated) {
      return response.redirect().toRoute(route.length > 0 ? route : this.defaultRedirect);
    }

    await next();
  }
}
