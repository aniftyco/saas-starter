/**
 * File source: https://bit.ly/3ukaHTz
 *
 * Feel free to let us know via PR, if you find something broken in this contract
 * file.
 */

import type { Config } from '@japa/runner';
import TestUtils from '@ioc:Adonis/Core/TestUtils';
import { browserClient, decoratorsCollection } from '@japa/browser-client';
import { expect } from '@japa/expect';
import { apiClient, assert, runFailedTests, specReporter } from '@japa/preset-adonis';

decoratorsCollection.register({
  context(context) {
    // Implement any helpers you want.
    // Example "Sign In":
    context.signIn = async function (email: string, password: string) {
      const page = await context.visit('/sign-in');
      const emailInput = page.getByLabel('Email Address');
      const passwordInput = page.getByLabel('Password');

      await emailInput.fill(email);
      await passwordInput.fill(password);

      await page.getByRole('button', { name: 'Sign In' }).click();

      return page;
    };
  },
});

declare module 'playwright' {
  // Declare the helpers onto context for usage.
  export interface BrowserContext {
    signIn(email: string, password: string): Promise<Page>;
  }
}

/*
|--------------------------------------------------------------------------
| Japa Plugins
|--------------------------------------------------------------------------
|
| Japa plugins allows you to add additional features to Japa. By default
| we register the assertion plugin.
|
| Feel free to remove existing plugins or add more.
|
*/
export const plugins: Required<Config>['plugins'] = [
  assert(),
  expect(),
  runFailedTests(),
  apiClient(),
  browserClient({
    runInSuites: ['e2e'],
  }),
];

/*
|--------------------------------------------------------------------------
| Japa Reporters
|--------------------------------------------------------------------------
|
| Japa reporters displays/saves the progress of tests as they are executed.
| By default, we register the spec reporter to show a detailed report
| of tests on the terminal.
|
*/
export const reporters: Required<Config>['reporters'] = [specReporter()];

/*
|--------------------------------------------------------------------------
| Runner hooks
|--------------------------------------------------------------------------
|
| Runner hooks are executed after booting the AdonisJS app and
| before the test files are imported.
|
| You can perform actions like starting the HTTP server or running migrations
| within the runner hooks
|
*/
export const runnerHooks: Pick<Required<Config>, 'setup' | 'teardown'> = {
  setup: [() => TestUtils.ace().loadCommands(), () => TestUtils.db().migrate()],
  teardown: [],
};

/*
|--------------------------------------------------------------------------
| Configure individual suites
|--------------------------------------------------------------------------
|
| The configureSuite method gets called for every test suite registered
| within ".adonisrc.json" file.
|
| You can use this method to configure suites. For example: Only start
| the HTTP server when it is a functional suite.
*/
export const configureSuite: Required<Config>['configureSuite'] = (suite) => {
  if (['functional', 'e2e'].includes(suite.name)) {
    suite.setup(() => TestUtils.httpServer().start());
  }
};
