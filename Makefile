DC=docker compose -f docker-compose.yml

.PHONY: up down sh logs test

up:
	$(DC) up -d --build
	$(DC) exec ng-logger composer install

down:
	$(DC) down

sh:
	$(DC) exec ng-logger bash

logs:
	$(DC) logs -f --tail=10

test:
	$(DC) exec ng-logger php vendor/bin/pest

test-coverage:
	$(DC) exec ng-logger php vendor/bin/pest --coverage

test-coverage-html:
	$(DC) exec ng-logger php vendor/bin/pest --coverage-html=report
