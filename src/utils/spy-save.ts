import Sinon from "sinon"

export type SaveSpy<T> = Sinon.SinonSpy<[T], Promise<T>>
