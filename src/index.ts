import { config } from "dotenv"
import { App } from "./app"
import { extensions } from "./modules"

config()
new App(extensions).boot()
