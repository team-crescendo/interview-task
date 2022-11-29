import { applicationCommand, Extension } from "@pikokr/command.ts"
import { ApplicationCommandType, ChatInputCommandInteraction } from "discord.js"

export class PingExtension extends Extension {
  @applicationCommand({
    type: ApplicationCommandType.ChatInput,
    name: "핑",
    description: "핑 하면 퐁 해요",
  })
  async ping(interaction: ChatInputCommandInteraction) {
    await interaction.reply("퐁!")
  }
}
