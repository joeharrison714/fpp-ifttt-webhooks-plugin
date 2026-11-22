#!/bin/bash

# fpp-ifttt-webhooks uninstall script

. ${FPPDIR}/scripts/common

# fppd only reads commands/descriptions.json at startup, so request a restart
# to drop the "IFTTT Webhook Trigger" command once the plugin is removed.
setSetting restartFlag 1

# The webhook key in config/plugin.fpp-ifttt-webhooks is kept on a Reinstall
# (FPP 10.4+ sets FPP_PLUGIN_REINSTALL=1) and removed on a real uninstall.
if [ "${FPP_PLUGIN_REINSTALL:-0}" != "1" ]; then
    rm -f "${MEDIADIR}/config/plugin.fpp-ifttt-webhooks"
fi
