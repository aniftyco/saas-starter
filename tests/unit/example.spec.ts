import { test } from '@japa/runner';

const add = (a: number, b: number) => a + b;

test.group('example / add(1,2)', () => {
  test('1 + 2 = 3', ({ expect }) => {
    expect(add(1, 2)).toEqual(3);
  });
});
