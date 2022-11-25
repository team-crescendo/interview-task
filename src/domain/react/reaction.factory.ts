import { Factory } from "fishery"
import { Reaction } from "./reaction.entity"

export const reactionFactory = Factory.define<Reaction>(({ sequence, params }) => {
  const reaction = new Reaction({
    id: `${sequence}`,
    keyword: `keyword${sequence}`,
    response: `Response of reaction ${sequence}`,
    reward: 1,
  })

  return Object.assign(reaction)
})
