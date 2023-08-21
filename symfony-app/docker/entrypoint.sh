#!/bin/sh
set -e

bin/console doctrine:migrations:migrate --no-interaction
symfony local:server:start -d
npm run dev

exec docker-php-entrypoint "$@"
