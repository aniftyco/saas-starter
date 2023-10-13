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
    Route.get('/sign-in', 'Auth/SignInController.index').as('sign-in');
    Route.post('/sign-in', 'Auth/SignInController.store');
    Route.get('/sign-up', 'Auth/SignUpController.index').as('sign-up');
    Route.post('/sign-up', 'Auth/SignUpController.store');
    Route.get('/forgot-password', 'Auth/ForgotPasswordController.index').as('forgot-password');
    Route.post('/forgot-password', 'Auth/ForgotPasswordController.store');
    Route.get('/reset-password/:token', 'Auth/ResetPasswordController.index').as('reset-password');
    Route.post('/reset-password/:token', 'Auth/ResetPasswordController.store');
  }).middleware('guest');
});

// Protected routes
Route.group(() => {
  Route.get('/dashboard', 'DashboardController').as('dashboard');
  Route.post('/sign-out', 'Auth/SignOutController').as('sign-out');
}).middleware('auth:web');
