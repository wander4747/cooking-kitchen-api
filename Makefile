SHELL := /bin/bash
.PHONY: help

help: ## Display this help message
	@echo -e "$$(grep -hE '^\S+:.*##' $(MAKEFILE_LIST) | sed -e 's/:.*##\s*/:/' -e 's/^\(.\+\):\(.*\)/\\x1b[36m\1\\x1b[m:\2/' | column -c2 -t -s :)"

start: ## Run app
start:
	docker-compose up -d

composer: ## Run composer
composer:
	docker-compose exec app composer install

migrate:
	docker-compose exec app php artisan migrate
