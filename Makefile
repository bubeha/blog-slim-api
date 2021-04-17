UID := $(shell id -u)
GID := $(shell id -g)

start:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer \
		&& time docker-compose up -d --build --remove-orphans nginx

stop:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose stop

down:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose down

update-deps:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer update

test-unit:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer test -- --testsuite=unit

test-unit-coverage:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer test-coverage -- --testsuite=unit

test-functional:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer test -- --testsuite=functional

test-functional-coverage:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer test-coverage -- --testsuite=functional

psalm:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer run psalm

lint:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer run phplint \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer run php-cs-fixer fix -- --dry-run --diff

cs-fix:
	export _UID="${UID}" \
		&& export _GID="${GID}" \
		&& time docker-compose run --rm --no-deps --user="${UID}:${GID}" composer run php-cs-fixer fix
