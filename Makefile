SHELL = /bin/sh

.PHONY: install test test-unit clean help

.SILENT: help

install: ## Download the depenedencies then build the image :rocket:.
	docker pull php:7.0-cli
	docker run -it --rm \
		-v $$(pwd):/usr/src/app \
		-v ~/.composer:/root/.composer \
		-v ~/.ssh:/root/.ssh:ro \
		graze/composer update --no-interaction

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
