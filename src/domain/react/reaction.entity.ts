import { Entity } from "../entity"

export type ReactionProperty = {
  id?: string
  keyword: string
  response: string
  reward: number
}

export class Reaction extends Entity {
  public readonly id!: string
  public readonly keyword!: string
  public readonly response!: string
  public readonly reward!: number

  constructor(props: ReactionProperty) {
    super(props)
  }
}
