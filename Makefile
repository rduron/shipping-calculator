up:
	docker compose up -d --build

down:
	docker compose down -v

test:
	docker exec zoo_php /bin/sh -c "vendor/bin/phpunit"
