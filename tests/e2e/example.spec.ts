import User from '@app/Models/User';
import Database from '@ioc:Adonis/Lucid/Database';
import { test } from '@japa/runner';

test.group('example / sign-in', (group) => {
  group.each.setup(async () => {
    await Database.beginGlobalTransaction();

    return () => Database.rollbackGlobalTransaction();
  });

  test('user can sign in', async ({ visit }) => {
    const email = 'jane.doe@example.com';
    const password = 'hunter2';

    await User.create({ name: 'Jane Doe', email, password });

    const page = await visit('/sign-in');

    await page.getByLabel('Email Address').fill(email);
    await page.getByLabel('Password').fill(password);

    await page.getByRole('button', { name: /Sign In/ }).click();

    await page.assertPath('/dashboard');
  });
});
