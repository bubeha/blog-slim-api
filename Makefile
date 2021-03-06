build:
	docker-compose build
	docker-compose run --rm --no-deps php-cli composer install
	docker-compose run --rm --no-deps nodejs yarn install

start: down build
	docker-compose up -d --remove-orphans php-fpm nodejs

stop:
	docker-compose stop

down:
	docker-compose down --remove-orphans

down-clear:
	docker-compose down -v --remove-orphans

pull:
	docker-compose pull

update-deps:
	docker-compose run --rm --no-deps php-cli composer update
	docker-compose run --rm --no-deps nodejs yarn upgrade

test-unit:
	docker-compose run --rm --no-deps php-cli composer test -- --testsuite=unit

test-unit-coverage:
	docker-compose run --rm --no-deps php-cli composer test-coverage -- --testsuite=unit

test: test-unit test-functional

test-functional:
	docker-compose run --rm --no-deps php-cli composer test -- --testsuite=functional

test-functional-coverage:
	docker-compose run --rm --no-deps php-cli composer test-coverage -- --testsuite=functional

psalm:
	docker-compose run --rm --no-deps php-cli composer run psalm -- --show-info=true

lint:
	docker-compose run --rm --no-deps php-cli composer run phplint
	docker-compose run --rm --no-deps php-cli composer run php-cs-fixer fix -- --dry-run --diff

cs-fix:
	docker-compose run --rm --no-deps php-cli composer run php-cs-fixer fix
