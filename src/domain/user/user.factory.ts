import { Factory } from "fishery"
import { User } from "./user.entity"

export const userFactory = Factory.define<User>(({ sequence, params }) => {
  const user = new User({
    id: `${sequence}`,
    username: `user${sequence}`,
    likability: 0,
    battery: 100,
    badgeIds: [],
    verifiedAt: new Date(),
  })

  return Object.assign(user, params)
})
