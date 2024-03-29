# Game Planning API

This is the back end of the Game Planning App, providing data management which can be used for planning game events. Game records can be created, read, updated, and deleted with user authentication.

Here is this front end's repository: https://github.com/JacobStephens2/game-planning-app.

## Endpoints

base URL: https://api.gameplanning.site (Not currently live)

The base URL returns JSON data and can be used as a test endpoint for connection to the API. Endpoints can be found at the base URL.

## Apache Directives

Faster performance and elimination of need to place this in many directories would come from putting these rules into the Apache configuration file for the virtual host as opposed to in a .htaccess file.

```
# Dev
Header set Access-Control-Allow-Origin "http://gameplanning.local"

# Prod
Header set Access-Control-Allow-Origin "https://gameplanning.site"

# All Environments
Header set Access-Control-Allow-Methods "GET, POST"
Header set Access-Control-Allow-Headers: Content-Type
Header set Access-Control-Allow-Credentials: true
Header set Content-Type "application/json; charset=UTF-8"
```
