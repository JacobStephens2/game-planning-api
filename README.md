# Game Planning App Back End

This is the back end of the Game Planning App, providing data which can be used for planning game events.

## Endpoints

base URL: https://api.gameplanning.site

The base URL returns JSON data and can be used as a test endpoint for connection to the API.

### /test/database

This endpoint returns JSON data from the backend's MySQL database and can be used as a test for database data from the API.

### /test/access

This endpoint returns data if the requester has a signed JWT token.
