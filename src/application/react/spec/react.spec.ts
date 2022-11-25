/* eslint-disable @typescript-eslint/no-explicit-any */

import anyTest, { ExecutionContext, TestFn } from "ava"
import * as Sinon from "sinon"
import { SinonSandbox } from "sinon"

import { isBusinessError } from "src/utils/business-error"
import { SaveSpy } from "src/utils/spy-save"

import { ReactRepository } from "src/infrastructure/persistence/react.repository"
import { UserRepository } from "src/infrastructure/persistence/user.repository"

import { Reaction } from "src/domain/react/reaction.entity"
import { reactionFactory } from "src/domain/react/reaction.factory"
import { User, UserProperty } from "src/domain/user/user.entity"
import { userFactory } from "src/domain/user/user.factory"

import { ReactApplication } from "../react.application"

type TestContext = {
  sandbox: SinonSandbox
  application: ReactApplication
  reactRepository: ReactRepository
  userRepository: UserRepository
  user: User
  reaction: Reaction
}
const test = anyTest as TestFn<TestContext>

test.beforeEach((test) => {
  const sandbox = Sinon.createSandbox()

  test.context.sandbox = sandbox
  test.context.reactRepository = {} as any
  test.context.userRepository = {} as any

  test.context.application = new ReactApplication(
    test.context.reactRepository,
    test.context.userRepository
  )

  setupDefaultCase(test)
})

test.afterEach((test) => test.context.sandbox.restore())

const setupDefaultCase = async (test: ExecutionContext<TestContext>) => {
  const { sandbox } = test.context

  const user = userFactory.build()
  const reaction = reactionFactory.build()

  test.context.user = user
  test.context.reaction = reaction

  test.context.userRepository.findById = sandbox.fake.resolves(user)
  test.context.userRepository.save = sandbox.fake(async (user) => user)
  test.context.reactRepository.findByKeyword = sandbox.fake.resolves(reaction)
}

test("키워드를 정확히 입력하면 알맞은 반응과 호감도 반영이 이루어져야 한다.", async (test) => {
  const { application, user, reaction } = test.context
  const expectLikability = user.likability + reaction.reward

  const result = await application.react(user.id, reaction.keyword)

  test.false(isBusinessError(result))
  if (isBusinessError(result)) return test.fail()

  test.true(result instanceof Reaction)
  test.is(user.likability, expectLikability)

  /* Test Presistence */
  const saveUser = test.context.userRepository.save as SaveSpy<User>
  test.true(saveUser.called)
  test.like<Partial<UserProperty>>(saveUser.firstCall.args[0], {
    id: user.id,
    likability: expectLikability,
  })
})

test.todo("동일 키워드의 반응이 여러개 존재할 시 그 중 랜덤으로 반응해야 한다.")
test.todo("유저가 존재하지 않을 시 에러가 발생해야 한다.")
test.todo("적절한 키워드가 존재하지 않을 시 에러가 발생해야 한다..")
test.todo("유사 키워드를 정상적으로 인식해야 한다.")
