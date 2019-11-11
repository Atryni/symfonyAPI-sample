#-------------------------------- Project --------------------------------------------------#
SHELL := /bin/bash
#-------------------------------- Project --------------------------------------------------#

start:
	@echo Project Makefile

build: dc-up symfony-build

#-------------------------------- Docker --------------------------------------------------#
DC_REST_API=docker-compose run --rm --user `id -u`:`id -g` php
DC_REST_API_ROOT=docker-compose run --rm php
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
#-------------------------------- Docker --------------------------------------------------#

# 	build instance
dc-build: 
	docker-compose build

# 	run instance
dc-up:
	docker-compose up -d

# 	stop instance
dc-down:
	docker-compose down

# 	check instance ports and status
dc-status:
	docker-compose ps

# 	remove all data from containers like DATABASE
dc-clean:
	docker-compose down --volumes

#------------------------------- REST Api -------------------------------------------------#

# 	login to REST_API instance as current user
symfony-bash:
	$(DC_REST_API) /bin/bash

# 	login to REST_API instance as root
symfony-bash-root:
	$(DC_REST_API_ROOT) /bin/bash

symfony-build:
	$(DC_REST_API) /bin/bash -c 'composer install && bin/console assets:install'
	$(DC_REST_API) /bin/bash -c 'bin/console doctrine:database:create --if-not-exists --no-interaction && bin/console doctrine:migration:migrate --allow-no-migration --no-interaction'

# 	REST_API run cs-fix
symfony-csfix:
	$(DC_REST_API) /bin/bash -c 'php-cs-fixer fix --config=./.php_cs'

# 	REST_API reset database
symfony-database-reset:
	$(DC_REST_API) /bin/bash -c 'bin/console doctrine:database:drop --if-exists --force && bin/console doctrine:database:create && bin/console doctrine:schema:update --force && bin/console doctrine:migration:version --add --all --no-interaction'

#--------------------------------- Git ----------------------------------------------------#
GIT_LAST_TAG = $(lastword $(shell git tag --sort=taggerdate))
GIT_VERSION := $(subst -RC, , $(subst v,, $(subst ., ,$(GIT_LAST_TAG))))
GIT_MAJOR := $(word 1, $(GIT_VERSION))
GIT_MINOR := $(word 2, $(GIT_VERSION))
GIT_PATCH := $(word 3, $(GIT_VERSION))
GIT_RC := $(word 4, $(GIT_VERSION))
#--------------------------------- Git ----------------------------------------------------#

tag-major:
ifeq ($(GIT_RC),)
	$(eval tag = v$(shell echo $(GIT_MAJOR) + 1 | bc).0.0)
else
	$(eval tag = v$(GIT_MAJOR).0.0)
endif
	git tag $(tag) -m $(tag)

tag-major-rc:
ifeq ($(GIT_RC),)
	$(eval tag = v$(shell echo $(GIT_MAJOR) + 1 | bc).0.0-RC1)
else
	$(eval tag = v$(GIT_MAJOR).0.0-RC$(shell echo $(GIT_RC) + 1 | bc))
endif
	git tag $(tag) -m $(tag)

tag-minor:
ifeq ($(GIT_RC),)
	$(eval tag = v$(GIT_MAJOR).$(shell echo $(GIT_MINOR) + 1 | bc).0)
else
	$(eval tag = v$(GIT_MAJOR).$(GIT_MINOR).0)
endif
	git tag $(tag) -m $(tag)

tag-minor-rc:
ifeq ($(GIT_RC),)
	$(eval tag = v$(GIT_MAJOR).$(shell echo $(GIT_MINOR) + 1 | bc).0-RC1)
else
	$(eval tag = v$(GIT_MAJOR).$(GIT_MINOR).0-RC$(shell echo $(GIT_RC) + 1 | bc))
endif
	git tag $(tag) -m $(tag)

tag-patch:
ifeq ($(GIT_RC),)
	$(eval tag = v$(GIT_MAJOR).$(GIT_MINOR).$(shell echo $(GIT_PATCH) + 1 | bc))
else
	$(eval tag = v$(GIT_MAJOR).$(GIT_MINOR).$(GIT_PATCH))
endif
	git tag $(tag) -m $(tag)

tag-patch-rc:
ifeq ($(GIT_RC),)
	$(eval tag = v$(GIT_MAJOR).$(GIT_MINOR).$(shell echo $(GIT_PATCH) + 1 | bc)-RC1)
else
	$(eval tag = v$(GIT_MAJOR).$(GIT_MINOR).$(GIT_PATCH)-RC$(shell echo $(GIT_RC) + 1 | bc))
endif
	git tag $(tag) -m $(tag)
