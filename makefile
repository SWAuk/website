current_dir=$(dir $(abspath $(firstword $(MAKEFILE_LIST))))

build:
	docker run --env-file ./.env --rm -it -v $(current_dir):/app composer build
install:
	docker run --env-file ./.env --rm -it -v $(current_dir):/app composer install
update:
	docker run --env-file ./.env --rm -it -v $(current_dir):/app composer update
