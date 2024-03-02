install: # разворачивание и запуск локально
	docker compose up -d
	docker compose exec backend composer install
	cp .env.example .env
	docker compose exec backend php artisan key:generate
	docker compose exec backend php artisan migrate:refresh --seed

	@echo 'Готово: http://localhost/'
