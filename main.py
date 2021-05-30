from discord.ext import commands


class CrescendoBot(commands.Bot):
    def __init__(self):
        super().__init__(command_prefix="!")

    def run(self, bot_token: str):
        super().run(bot_token, reconnect=True)

    async def on_ready(self):
        print(f"logged in as {self.user}!")
        self.load_extension("commands")

    async def on_command_error(self, ctx, error):
        ignore_exception_list = [
            commands.CommandNotFound,
            commands.MissingRequiredArgument
        ]

        if any(isinstance(error, i) for i in ignore_exception_list):
            return

        return await ctx.send(f"Error!```py\n{type(error)}: {error}```")

    async def close(self):
        await super().close()


bot = CrescendoBot()
bot.run("Bot token here!")
