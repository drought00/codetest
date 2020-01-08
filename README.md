Migrate database to make the importer work
> php artisan migrate

Importer was created like an api. Run this command to import
> curl -i HOST_DOMAIN/api/import

APIs
Get All Players: 
HOST_DOMAIN/api/players

Get Player Details: 
HOST_DOMAIN/api/players/{player_id}

CONTROLLER:
 - app/http/IndexController

MODEL: 
 - app/Players.php

IMPORTER: 
 - app/Importer.php

TEST:
 - tests/Feature/ApiTest.php

ROUTES:
- routes/api.php