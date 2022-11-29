import { Extension } from "@pikokr/command.ts"
import { PingExtension } from "./ping.module"

export const extensions: Extension[] = [new PingExtension()]
