from discord.ext.commands import Cog, Context, command

from Xsi import XsiTestingBot


class Nim31(Cog):
    def __init__(self, bot: XsiTestingBot):
        self.bot = bot
        self.logger = bot.get_logger(self)

        self.logger.info("initialized")

    @command(aliases=["test"])
    async def foo(self, ctx: Context):
        return await ctx.send("bar")


def setup(bot: XsiTestingBot):
    bot.add_cog(Nim31(bot))
