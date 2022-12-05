# IFTTT Webhooks Plugin for FPP
This plugin allows you to send a webhook event to IFTTT which you can use as a trigger for anything that IFTTT can connect to, like SmartThings, Hubitat, Wyze, Kasa, Hue, Twitter, etc.

## Setup
1. Register/Login to IFTTT and visit this page: <a href="https://ifttt.com/maker_webhooks" target="_blank">https://ifttt.com/maker_webhooks</a> and click the Connect button if you've never used the webhook integration before.<br /><strong>NOTE: </strong>If you are signing up for IFTTT for the first time, it may try to force you to sign up for a pro trial. Once you verify you email address, it should bypass this and let you use the free version.
1. On that same link above, click the Documentation link to obtain your webhook key. Enter the key into the plugin settings.
1. On that same link above, click the Connect button to create a new applet.
1. For the "If This" section of the applet, click Add and search for Webhooks.
1. Choose "Receive a web request"
1. Enter an "Event Name" and click "Create Trigger". The event name can be anything you want, but it will need to match the event name you will use in the FPP command. (Suggestion: lead_in, lead_out, etc.)
1. For the "Then that" section of the applet, search for whatever service you want to use and select what you what to happen. This will vary based on the service and will hopefully be intuitive.
1. Review and Finish the applet creation.
1. In FPP, go to the plugin settings and test the event by entering the "Event Name" you used above and click "Send Test Event". Check to see if the action was performed. If not, you can troubleshoot this by checking the plugin log file and checking the activity of the applet in IFTTT
1. Once it is working, you can now add the FPP Command "IFTTT Webhook Trigger" with the "Event Name" throughout fpp, such as in a playlist or schedule.

## Advanced Usage
You can also have the plugin send a payload to IFTTT with the event, such as the current FPPD status. You could then configure IFTTT to "Receive a web request with a JSON payload". You could then query the data of the payload (With IFTTT Pro) and react based on the content of the payload, such as player status or current song, etc. I have no idea what you might do with this, perhaps send a tweet with the current song? I don't know, but if you think of something I would love to hear about it!