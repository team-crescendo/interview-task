from discord.ext import commands


class CommandsCog(commands.Cog):
    def __init__(self, bot):
        self.bot = bot

    # 아래 명령어 함수들은 discord.py의 작동 예제입니다.
    # 과제에 관련된 명령어 함수들은 여기에 작성해주시면 됩니다.
    # 아래 예제 명령어들은 지우고 제출해도 무방합니다.

    # Cog extension을 갱신합니다.
    # 자세한 사항은 https://discordpy.readthedocs.io/en/stable/ext/commands/extensions.html 을 참조하세요.
    @commands.command(name="reload")
    async def command_reload_cog(self, ctx):
        try:
            self.bot.reload_extension("commands")
        except Exception as e:
            return await ctx.send(f"reload failed: ```py\n{e}```")
        return await ctx.send("reload complete!")

    # 봇을 종료합니다.
    @commands.command(name="shutdown")
    async def command_bot_shutdown(self, ctx):
        await ctx.send("goodbye!")
        return await self.bot.close()

    # 입력받은 메세지를 그대로 출력합니다.
    @commands.command(name="print")
    async def command_print(self, ctx, *, message=None):
        return await ctx.send(message)


def setup(bot):
    bot.add_cog(CommandsCog(bot))
