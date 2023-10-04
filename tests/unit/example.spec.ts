import { test } from '@japa/runner';

const add = (a: number, b: number) => a + b;

test('1 + 2 = 3', ({ assert }) => {
  assert.equal(add(1, 2), 3);
});
