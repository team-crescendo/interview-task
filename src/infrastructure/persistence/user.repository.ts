import { User } from "src/domain/user/user.entity"

export class UserRepository {
  async findById(id: string): Promise<User | null> {
    throw new Error("Not Implemented")
  }

  async save(user: User): Promise<User> {
    throw new Error("Not Implemented")
  }
}
