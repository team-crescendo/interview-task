import { Entity } from "../entity"

export type BadgeProperty = {
  id?: string
  title: string
  description: string
}

export class Badge extends Entity {
  public readonly id!: string
  public readonly title!: string
  public readonly description!: string

  constructor(props: BadgeProperty) {
    super(props)
  }
}
