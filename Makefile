ifneq (,$(wildcard ./.env))
    include .env
    export
endif

DOCKER_COMPOSE = docker compose
EXEC_PHP = $(DOCKER_COMPOSE) exec php
EXEC_MYSQL = $(DOCKER_COMPOSE) exec mysql
EXEC_NODE = $(DOCKER_COMPOSE) exec node

.PHONY: migrate docker-down docker-up docker-down-force composer-install storage-link

docker-up-build: 
	$(DOCKER_COMPOSE) up -d --build
# 	@$(MAKE) wait-for-database

docker-up:
	$(DOCKER_COMPOSE) up -d

docker-down:
	$(DOCKER_COMPOSE) down

docker-down-force:
	$(DOCKER_COMPOSE) down -v

root:
	$(DOCKER_COMPOSE) exec -u root php /bin/sh

wait-for-database:
	@chmod +x ./docker/bin/wait-for.sh
	@./docker/bin/wait-for.sh $(APP_URL) $(APP_POSTGRES_PORT)

keys:
	$(EXEC_PHP) php artisan key:generate
	
composer-install:
	$(EXEC_PHP) git config --global --add safe.directory /var/www
	$(EXEC_PHP) composer install

database-drop-data:
	sudo rm -rf docker/database/data
	mkdir docker/database/data

storage-link:
	$(EXEC_PHP) php artisan storage:link

set-env-dev:
	cp .env.dev .env

set-env-prod:
	cp .env.prod .env

set-overrides-dev:
	cp docker-compose.override.dev.yaml.dist docker-compose.override.yaml

set-overrides-prod:
	cp docker-compose.override.prod.yaml.dist docker-compose.override.yaml

migrate:
	@for i in $$(seq 1 10); do \
		echo "Migration attempt $$i..."; \
		if $(EXEC_PHP) php artisan migrate:refresh --seed > /dev/null 2>&1; then \
			echo "Migrations successful!"; \
			exit 0; \
		fi; \
		sleep 3; \
	done; \
	echo "Migrations failed after 10 attempts."; \
	exit 1

npm-install:
	$(EXEC_NODE) npm install

npm-build:
	$(EXEC_NODE) npm run build

init: docker-up-build composer-install keys storage-link migrate npm-install npm-build

reset: docker-down-force database-drop-data

dev: set-env-dev set-overrides-dev init

prod: set-env-prod set-overrides-prod init

