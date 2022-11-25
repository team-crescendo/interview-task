export abstract class Entity {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  constructor(props?: any) {
    Object.assign(props)
  }

  protected get mutable() {
    return this as { -readonly [K in keyof this]: this[K] }
  }
}
