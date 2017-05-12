# Resize Photos
 - Consume a webservice endpoint (http://54.152.221.29/images.json) that returns a JSON of photos. There are 10 photos.
 - Generate three different formats for each photo. The dimensions are: small (320x240), medium (384x288) and large (640x480).
 - Endpoint that lists (in JSON format) all the ten photos with their respective formats, providing their URLs.

## Why PHP?
This is the programming language I am more experienced.
## Install
```
git clone https://github.com/joaoeduardo/resize-photos.git
cd resize-photos
composer install
```
## Use
Run on bash:
```
php artisan sync
```
Then access the project in your browser - if you use homestead, access `homestead.app`.

## Test
```
php vendor/bin/phpunit
```