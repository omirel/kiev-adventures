# Sulu Minimal Edition

Welcome to the Sulu Minimal Edition - a fully-functional Sulu application that you can use as the skeleton for your new
applications.

## Installation

__Docker setup__
```
docker exec -it kiev-adventures-web php bin/adminconsole sulu:build dev
docker exec -it kiev-adventures-web php bin/adminconsole assets:install

docker exec -it kiev-adventures-web php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
docker exec -it kiev-adventures-web php composer-setup.php
docker exec -it kiev-adventures-web php -r "unlink('composer-setup.php');"
docker exec -it kiev-adventures-web php composer.phar install

docker exec -it kiev-adventures-web chown -R www-data /var/www
docker exec -it kiev-adventures-web rm -rf /var/www/var/cache/*

```

__Docker deployment setup__

@see https://medium.com/@jontorrado/deploying-a-symfony2-project-with-magallanes-28abe452c54c
```
docker exec -it kiev-adventures-web bin/mage init --name=kiev-adventures --email=olaf@mirel.de
docker exec -it kiev-adventures-web bin/mage add environment --name="production" --enableReleases
```

__Docker deployment__
```
docker exec -it kiev-adventures-web bin/mage deploy to:production
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
