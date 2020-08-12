from logging import getLogger, Formatter, StreamHandler

from discord.ext.commands import AutoShardedBot


class XsiTestingBot(AutoShardedBot):
    name: str = "XsiBot"

    def __init__(self, *args, **kwargs):
        kwargs.setdefault("command_prefix", "테스야 ")
        super().__init__(*args, **kwargs)

        # Console 로깅 설정
        logger = getLogger(self.name or self.__class__.__name__)
        formatter = Formatter('[%(asctime)s %(levelname)s] (%(name)s: %(filename)s:%(lineno)d) > %(message)s')

        handler = StreamHandler()
        handler.setLevel('DEBUG')
        handler.setFormatter(formatter)
        logger.addHandler(handler)

        logger.setLevel('DEBUG')
        self.logger = logger

    def get_logger(self, cog):
        name = cog.__class__.__name__
        logger = getLogger(name and self.name + "." + name or self.name)
        logger.setLevel('DEBUG')
        return logger

    def run(self, *args, **kwargs):
        self.logger.info("Starting bot")
        super().run(*args, **kwargs)

    async def on_ready(self):
        self.logger.info("Bot ready")
        self.logger.info("= User: {} #{}".format(self.user, self.user.id))
        self.logger.info("= Guilds: {:,}".format(len(self.guilds)))
