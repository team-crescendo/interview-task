import os

from Xsi import XsiTestingBot

TOKEN = ""
extension_base = "cogs."
extensions = (
    "nim_31",
    )

bot = XsiTestingBot()

for ext in extensions:
    bot.load_extension(extension_base + ext)

bot.run(TOKEN or os.environ.get("xsi_test_token"))
