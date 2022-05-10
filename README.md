# Game Planning App Back End

This is the back end of the Game Planning App, providing data which can be used for planning game events.

## Endpoints

base URL: https://api.gameplanning.site

The base URL returns JSON data and can be used as a test endpoint for connection to the API. Endpoints can be found at the base URL.

## Apache Directives

Faster performance and elimination of need to Place this in many directories would come from putting these rules into the Apache configuration file for the virtual host

```
# Dev
Header set Access-Control-Allow-Origin "http://gameplanning.local"
Header set Access-Control-Allow-Methods "GET, POST"
Header set Access-Control-Allow-Headers: Content-Type
Header set Content-Type "application/json; charset=UTF-8"

# Prod
Header set Access-Control-Allow-Origin "https://gameplanning.site"
Header set Access-Control-Allow-Methods "GET, POST"
Header set Access-Control-Allow-Headers: Content-Type
Header set Content-Type "application/json; charset=UTF-8"
```
