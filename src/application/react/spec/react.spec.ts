import anyTest, { TestFn } from "ava"

const test = anyTest as TestFn

test.todo("키워드를 정확히 입력했을 알맞은 반응과 호감도 반영이 이루어져야 한다.")
test.todo("동일 키워드의 반응이 여러개 존재할 시 그 중 랜덤으로 반응해야 한다.")
test.todo("유저가 존재하지 않을 시 에러가 발생해야 한다.")
test.todo("적절한 키워드가 존재하지 않을 시 에러가 발생해야 한다..")
test.todo("유사 키워드를 정상적으로 인식해야 한다.")
