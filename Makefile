MIN_MAKE_VERSION := 3.81

ifneq ($(MIN_MAKE_VERSION),$(firstword $(sort $(MAKE_VERSION) $(MIN_MAKE_VERSION))))
$(error GNU Make $(MIN_MAKE_VERSION) or higher required)
endif

.DEFAULT_GOAL:=help

DOCKER_COMPOSE := docker compose --file docker-compose.yml
COMPOSER := $(DOCKER_COMPOSE) exec app composer --no-interaction

##@ Development
.PHONY: bash cs cs-fix down phplint phpstan phpunit up

bash: ## Application Container Bash
	@$(DOCKER_COMPOSE) exec app bash

cs: ## Run PHP Coding Standards Check
	@$(COMPOSER) cs

cs-fix: ## Run PHP Coding Standards Fix
	@$(COMPOSER) cs-fix

composer-install: ## Install Composer dependencies
	@$(COMPOSER) install

composer-update: ## Update Composer dependencies
	@$(COMPOSER) update

phplint: ## Perform PHPLint - Syntax Error Check
	@$(COMPOSER) phplint

phpstan: ## Run PHP Static Analysis Tool
	@$(COMPOSER) phpstan

phpunit: ## Run PHPUnit Tests Without Coverage
	@$(COMPOSER) phpunit

phpunit-coverage: ## Run PHPUnit Tests With Coverage Report
	@$(COMPOSER) phpunit-coverage

up: ## Create Application Container
	@$(DOCKER_COMPOSE) up --build --detach

down: ## Stop Application Container And Remove Volumes
	@$(DOCKER_COMPOSE) down --volumes

.PHONY: help
help:
	@awk 'BEGIN {FS = ":.*##"; printf "Usage: make \033[36mTARGET [ARG...]\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-25s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

