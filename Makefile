init: app-network docker-down-clear docker-pull docker-build docker-up app-init
app-init: app-composer-install app-wait-db app-wait-db-test app-migrations app-migrations-test app-fixtures
check: cs psalm schema-validate deep-module deep-layers rector

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-down-clear:
	docker compose down -v --remove-orphans

docker-pull:
	docker compose pull

docker-build:
	docker compose build

app-composer-install:
	docker compose run --rm credit-test-php-cli composer install

app-network:
	docker network create credit-test-network || true

app-wait-db:
	until docker compose exec -T credit-test-postgres pg_isready --timeout=0 --dbname=db ; do sleep 1 ; done

app-wait-db-test:
	until docker compose exec -T credit-test-postgres pg_isready --timeout=0 --dbname=db_test ; do sleep 1 ; done

app-migrations:
	docker compose run --rm credit-test-php-cli php bin/console do:database:drop -nq --force --if-exists
	docker compose run --rm credit-test-php-cli php bin/console do:database:create -nq
	docker compose run --rm credit-test-php-cli php bin/console doctrine:migrations:migrate --no-interaction || true

app-migrations-test:
	docker compose run --rm credit-test-php-cli php bin/console do:database:drop -nq --force --if-exists --env=test
	docker compose run --rm credit-test-php-cli php bin/console do:database:create -nq --env=test
	docker compose run --rm credit-test-php-cli php bin/console do:mi:mi -n --env=test || true

app-fixtures:
	docker compose run --rm credit-test-php-cli php bin/console do:fixtures:load -n  --group=test --env=test

psalm:
	docker compose run --rm credit-test-php-cli composer psalm

cs:
	docker compose run --rm credit-test-php-cli composer cs-check

deep-module:
	docker compose run --rm credit-test-php-cli php bin/deptrac.phar analyze --config-file=bin/deeptrac.yaml

deep-layers:
	docker compose run --rm credit-test-php-cli php bin/deptrac.phar analyze --config-file=bin/deeptrac-layers.yaml

rector:
	docker compose run --rm credit-test-php-cli vendor/bin/rector process src --dry-run

schema-validate:
	docker compose run --rm credit-test-php-cli php bin/console do:schema:validate

test:
	docker compose run --rm credit-test-php-cli composer test
