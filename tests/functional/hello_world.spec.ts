import { test } from '@japa/runner';

test.group('example / GET /', () => {
  test('status:200', async ({ client }) => {
    const response = await client.get('/');

    response.assertStatus(200);
  });
});
