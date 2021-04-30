UID := $(shell id -u)
GID := $(shell id -g)

build:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose build \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer install \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" nodejs yarn install

init: build start

start:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose up -d --remove-orphans

stop:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose stop

down:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose down --remove-orphans

down-clear:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose down -v --remove-orphans

update-deps:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer update

test-unit:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer test -- --testsuite=unit

test-unit-coverage:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer test-coverage -- --testsuite=unit

test: test-unit test-functional

test-functional:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer test -- --testsuite=functional

test-functional-coverage:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer test-coverage -- --testsuite=functional

psalm:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer run psalm

lint:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer run phplint \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer run php-cs-fixer fix -- --dry-run --diff

cs-fix:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" php-cli composer run php-cs-fixer fix
