export class BusinessError<T extends string> {
  constructor(public readonly error: T) {}
}

export const isBusinessError = (
  value: BusinessError<string> | unknown
): value is BusinessError<string> => value instanceof BusinessError
