import { CommandClient, Extension } from "@pikokr/command.ts"
import { Client } from "discord.js"

export class App {
  private readonly client: Client
  private readonly commands: CommandClient

  constructor(private readonly extensions: Extension[]) {
    this.client = new Client({
      intents: ["Guilds", "DirectMessages"],
    })
    this.commands = new CommandClient(this.client)
  }

  public async boot() {
    await this.commands.enableApplicationCommandsExtension({})

    Promise.all(this.getModuleRegisterPromises())

    await this.client.login(process.env.BOT_TOKEN)
    await this.commands.getApplicationCommandsExtension()?.sync()
  }

  private getModuleRegisterPromises() {
    return this.extensions.map(
      (extension): Promise<void> => this.commands.registry.registerModule(extension)
    )
  }
}
