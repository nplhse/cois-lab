.DEFAULT_GOAL = help
.PHONY        : help

# Executables
COMPOSER      = composer
SYMFONY       = symfony

# Alias
CONSOLE       = $(SYMFONY) console

# Vendor executables
PHPUNIT       = ./vendor/bin/phpunit
PHPSTAN       = ./vendor/bin/phpstan
PHP_CS_FIXER  = ./vendor/bin/php-cs-fixer

## —— 🎵 🐳 The Symfony Docker makefile 🐳 🎵 ——————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Project setup 🚀 ——————————————————————————————————————————————————————————
install: ## Setup the whole project
	@$(COMPOSER) install --no-interaction

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
vendor: composer.lock ## Install vendors according to the current composer.lock file
	@$(COMPOSER) install --prefer-dist --no-dev --no-progress --no-interaction

## —— Coding standards ✨ ——————————————————————————————————————————————————————
ci: lint-php static-analysis ## Run continuous integration pipeline

cs: fix-php ## Run all coding standards checks

static-analysis: phpstan ## Run the static analysis

fix-php: ## Fix files with php-cs-fixer
	@PHP_CS_FIXER_IGNORE_ENV=1 $(PHP_CS_FIXER) fix

lint-php: ## Lint files with php-cs-fixer
	@PHP_CS_FIXER_IGNORE_ENV=1 $(PHP_CS_FIXER) fix --dry-run

phpstan: ## Run PHPStan
	@$(PHPSTAN) analyse --memory-limit=-1

## —— Tests ✅ —————————————————————————————————————————————————————————————————
test: ## Run tests
	@$(PHPUNIT) --stop-on-failure -d memory_limit=-1

testdox: ## Run tests with testdox
	@$(PHPUNIT) --testdox -d memory_limit=-1

## —— Cleanup 🚮 ————————————————————————————————————————————————————————————————
purge: ## Purge temporary files
	@rm -rf public/assets/*
	@rm -rf var/cache/* var/logs/*

clear: ## Cleanup everything
	@rm -rf vendor/*
	@rm -rf public/assets/*
	@rm -rf var/cache/* var/logs/*
