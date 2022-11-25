import { Entity } from "../entity"
import { Reaction } from "../react/reaction.entity"

export type UserProperty = {
  id?: string
  username: string
  likability: number
  battery: number
  badgeIds: string[]
  verifiedAt?: Date
}

export class User extends Entity {
  public readonly id!: string
  public readonly username!: string
  public readonly likability!: number
  public readonly battery!: number
  public readonly badgeIds!: string[]
  public readonly verifiedAt?: Date

  constructor(props: UserProperty) {
    super(props)
  }

  public get likeLevel(): number {
    throw new Error("Not Implemented")
  }

  public setRewardForReaction(reaction: Reaction) {
    this.mutable.likability += reaction.reward
  }
}
