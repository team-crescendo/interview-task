export class User {
  id!: string
  username!: string
  likability!: number
  battery!: number
  badgeIds!: string[]
  verifiedAt?: Date

  public get likeLevel(): number {
    throw new Error("Not Implemented")
  }
}
