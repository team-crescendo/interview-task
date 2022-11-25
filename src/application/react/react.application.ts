import { ReactRepository } from "src/infrastructure/persistence/react.repository"
import { UserRepository } from "src/infrastructure/persistence/user.repository"
import { BusinessError } from "src/utils/business-error"

export class ReactApplication {
  constructor(private reactRepository: ReactRepository, private userRepository: UserRepository) {}

  async react(userId: string, chat: string) {
    const user = await this.userRepository.findById(userId)
    if (!user) return new BusinessError("no-user")

    const reaction = await this.reactRepository.findByKeyword(chat)
    if (!reaction) return new BusinessError("no-reaction")

    user.setRewardForReaction(reaction)

    await this.userRepository.save(user)

    return reaction
  }
}
