# Sulu Minimal Edition

Welcome to the Sulu Minimal Edition - a fully-functional Sulu application that you can use as the skeleton for your new
applications.

## Installation

__Docker__
```
docker exec -it kiev-adventures-web php bin/adminconsole sulu:build dev
docker exec -it kiev-adventures-web php bin/adminconsole assets:install

docker exec -it kiev-adventures-web php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
docker exec -it kiev-adventures-web php composer-setup.php
docker exec -it kiev-adventures-web php -r "unlink('composer-setup.php');"
docker exec -it kiev-adventures-web php composer.phar install
```

__Linux:__

```
rm -rf var/cache/*
rm -rf var/logs/*
rm -rf var/sessions/*
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache var/logs var/uploads var/uploads/* web/uploads web/uploads/* var/indexes var/sessions
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache var/logs var/uploads var/uploads/* web/uploads web/uploads/* var/indexes var/sessions
```
