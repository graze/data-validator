SHELL = /bin/sh

DOCKER = $(shell which docker)
PHP_VER := 7.4
IMAGE := graze/php-alpine:${PHP_VER}-test
VOLUME := /srv
DOCKER_RUN_BASE := ${DOCKER} run --rm -t -v $$(pwd):${VOLUME} -w ${VOLUME}
DOCKER_RUN := ${DOCKER_RUN_BASE} ${IMAGE}

PREFER_LOWEST ?=

.PHONY: build build-update composer-% clean help run
.PHONY: lint lint-fix
.PHONY: test test-unit test-integration test-lowest test-matrix test-coverage test-coverage-html test-coverage-clover

.SILENT: help

# Building

build: ## Install the dependencies
build: ensure-composer-file
	make 'composer-install --optimize-autoloader --prefer-dist ${PREFER_LOWEST}'

build-update: ## Update the dependencies
build-update: ensure-composer-file
	make 'composer-update --optimize-autoloader --prefer-dist ${PREFER_LOWEST}'

ensure-composer-file: # Update the composer file
	make 'composer-config platform.php ${PHP_VER}'

composer-%: ## Run a composer command, `make "composer-<command> [...]"`.
	${DOCKER} run -t --rm \
        -v $$(pwd):/app:delegated \
        -v ~/.composer:/tmp:delegated \
        -v ~/.ssh:/root/.ssh:ro \
        composer --ansi --no-interaction $* $(filter-out $@,$(MAKECMDGOALS))

test: ## Run all the tests 🚀.
test: test-unit

test-unit: ## Run the unit testsuite.
	docker run --rm -t -v $$(pwd):/usr/src/graze-queue -w /usr/src/graze-queue php:7.0-cli \
	vendor/bin/phpunit --testsuite unit

clean: ## Clean up the project.
	rm -rf vendor/

help: ## Show this help message.
	echo "usage: make [target] ..."
	echo ""
	echo "targets:"
	fgrep --no-filename "##" $(MAKEFILE_LIST) | fgrep --invert-match $$'\t' | sed -e 's/: ## / - /'
