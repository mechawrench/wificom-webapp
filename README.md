# WiFiCom WebApp (Built using Laravel)

## Description
This repo contains the webapp code used on the serverside for the WiFiCom project.  This code is open source and free 
for use by anyone.

### Requirements
* [Mosquitto Docker Instance](https://github.com/mechawrench/wificom-mosquitto-docker)
* [Wificom-lib](https://github.com/mechawrench/wificom-lib)

## Documentation
These docs are incomplete at this time, but enough information is given to get you started if you're familiar with Laravel.

### Installation
1. Clone the repo
2. Deploy using a php stack such as wamp/lmap/xampp, you can also use Laravel Forge or Ploi.io to automatically build out the required infrastructure and security.
3. Run the following command to copy the .env.example file to .env:
```
cp .env.example .env
``` 
4. Run the following command to install composer dependencies:
```
composer install --no-dev
```
5. Run the following command to install npm dependencies:
```
npm install && npm run build
```
6. Generate a new App Key
```
php artisan key:generate
```
7. Ensure you have a database ready to go with a user and password
   1. Edit the .env file and add your database credentials
8. Run the following command to migrate the database:
```
php artisan migrate --force
```
9. Run the following command to seed the database:
```
php artisan db:seed
```
    - Pay attention to the output here, your initial admin user and login is provided, you'll need these later

10. Populate the remaining ENV variables
    1. You'll need the following
       - APP_NAME=WiFiCom
       - ASSET_URL=https://yoursiteurl.com
       - APP_URL=https://yoursiteurl.com
       - an email server
       - a digitalocean spaces bucket
       - MQTT server setup
         - MQTT_AUTH_USERNAME=admin
         - MQTT_AUTH_PASSWORD=PASSWORD_FROM_EARLIER_IN_CLI_OUTPUT
       - Sentry DSN (Optional, used to track errors)

11. You'll need to setup a cron job for the scheduler to run every minute
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
12. You'll need to setup a daemon for the mqtt:listener to run eternally
    1. Use Supervisor to start the daemon
    ```cd /path-to-your-project && php artisan mqtt:listener```
13. Ensure you can access the site
14. Create an account (will require email verification)
15. Test out the features, report back with any issues on this Repo
