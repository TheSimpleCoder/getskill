up:
	docker-compose up -d

down:
	docker-compose down --remove-orphans

build:
	docker-compose up --build -d

test:
	docker-compose exec php-cli vendor/bin/phpunit

init: down build up

enter:
	docker-compose exec php-cli bash -i

composer:
	docker-compose run --rm php-cli composer

assets-install:
	docker-compose exec node yarn install

assets-rebuild:
	docker-compose exec node npm rebuild node-sass --force

assets-dev:
	docker-compose exec node yarn run dev

assets-watch:
	docker-compose exec node yarn run watch

queue:
	docker-compose exec php-cli php artisan queue:work

horizon:
	docker-compose exec php-cli php artisan horizon

horizon-pause:
	docker-compose exec php-cli php artisan horizon:pause

horizon-continue:
	docker-compose exec php-cli php artisan horizon:continue

horizon-terminate:
	docker-compose exec php-cli php artisan horizon:terminate

memory:
#	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chown -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
