docker-symfony
==============

This is a complete stack for running Symfony 4 (latest version: Flex) into Docker containers using docker-compose tool.

# Installation

First, clone this repository:

```bash
git clone https://github.com/Atryni/docker-symfony.git
```

Next, put your Symfony application into `code` folder or run with default prepared for API Symfony project.

Prepare docker-compose ports and network name by modifying default `.env` file parameters

```dotenv
### docker-compose
# Ports
DATABASE_PORT=5444:5432
NGINX_PORT=8111:80
MAILCATCHER_PORT=80

# Network
COMPOSE_PROJECT_NAME='docker_symfony'
``` 

Then, run:

```bash
make build
```

You are done, you can visit your Symfony application on the following URL: `http://localhost:$NGINX_PORT`

_Note :_ you can rebuild all Docker images by running:

```bash
docker-compose build
# OR
make dc-build
```

# How it works?

Here are the `docker-compose` built images:

* `database`: This is the PostgreSQL database container (can be changed to mysql or whatever in `docker-compose.yml` file),
* `php`: This is the PHP-FPM container including the application volume mounted on,
* `nginx`: This is the Nginx webserver container in which php volumes are mounted too,
* `mailcatcher`: This is the Mailcatcher additional container service protecting against accidental sending of unwanted emails during tests 

This results in the following running containers: (`docker-compose ps`)

```bash
            Name                          Command               State                      Ports                    
--------------------------------------------------------------------------------------------------------------------
docker_symfony_database_1      docker-entrypoint.sh postgres    Up      0.0.0.0:5444->5432/tcp                      
docker_symfony_mailcatcher_1   mailcatcher --foreground - ...   Up      0.0.0.0:32795->25/tcp, 0.0.0.0:32794->80/tcp
docker_symfony_nginx_1         nginx -g daemon off;             Up      0.0.0.0:8111->80/tcp                        
docker_symfony_php_1           docker-php-entrypoint php- ...   Up      9000/tcp                                    
```