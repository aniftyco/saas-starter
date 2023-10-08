/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| This file is dedicated for defining HTTP routes. A single file is enough
| for majority of projects, however you can define routes in different
| files and just make sure to import them inside this file. For example
|
| Define routes in following two files
| ├── start/routes/cart.ts
| ├── start/routes/customer.ts
|
| and then import them inside `start/routes.ts` as follows
|
| import './routes/cart'
| import './routes/customer''
|
*/

import Route from '@ioc:Adonis/Core/Route';

// Unprotected routes
Route.group(() => {
  Route.on('/').render('welcome').as('welcome');

  // Only allow guests to access these
  Route.group(() => {
    Route.on('/sign-up').render('pages/sign-up').as('sign-up');
    Route.post('/sign-up', 'AuthController.signUp');
    Route.get('/sign-in', ({ request, view }) =>
      view.render('pages/sign-in', { returnUrl: request.qs().returnUrl ?? Route.makeUrl('dashboard') })
    ).as('sign-in');
    Route.post('/sign-in', 'AuthController.signIn');
    Route.on('/forgot-password').render('pages/forgot-password').as('forgot-password');
    Route.post('/forgot-password', 'AuthController.forgotPassword');
    Route.get('/reset-password/:token', 'AuthController.renderResetForm').as('reset-password');
    Route.post('/reset-password/:token', 'AuthController.resetPassword');
  }).middleware('guest');
});

// Protected routes
Route.group(() => {
  Route.on('/dashboard').render('pages/dashboard').as('dashboard');
  Route.post('/sign-out', 'AuthController.signOut').as('sign-out');
}).middleware('auth:web');
