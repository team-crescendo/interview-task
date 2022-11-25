import { Reaction } from "src/domain/react/reaction.entity"

export class ReactRepository {
  async findByKeyword(keyword: string): Promise<Reaction | null> {
    throw new Error("Not Implemented")
  }
}
