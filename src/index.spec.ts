import anyTest, { TestFn } from "ava"

const test = anyTest as TestFn

test("ava availabe", (test) => {
  test.is(1 + 1, 2)
})
