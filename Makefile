dev:
	make -j 2 serve watch

serve:
	php -S localhost:8000 -t public
watch:
	npm run watch

update:
	@composer.phar clear-cache
	@composer.phar update

autoload:
	@composer.phar dump-autoload

migrate:
	php artisan migrate
seed:
	php artisan db:seed

build-secret:
	php artisan key:generate
	@composer run-script post-create-project-cmd

init-database:
	make migrate
	make autoload
	make seed

clear:
	@composer.phar clear-cache
	@composer.phar dump-autoload -o

init-build: 
	touch database/database.sqlite
	make build-secret
	make install
	make init-database

clean-lock:
	rm package-lock.json
	rm yarn.lock
clean-vendors:
	rm -rf vendor
	rm -rf node_modules
clear-install:
	make clean-vendors
	make clean-lock
	make clear
	make install
	php artisan migrate:refresh --seed
	make seed

clear-db:
	echo "" > database/database.sqlite
	php artisan migrate:refresh --seed

# Terminal commands
migration:
	php artisan make:migration create_$(name)_table
model:
	php artisan make:model 'Models\$(name)'

install:
	npm i
	@composer.phar install