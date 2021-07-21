setup: ## laravelの環境を立ち上げるためのセットアップ（色々設定が足りてない場合失敗します）
	cp .env.example .env
	cp .env.testing.example .env.testing
	php artisan migrate
	php artisan db:seed
	php artisan storage:link

build-nocache: ## noccache build
	./vendor/bin/sail build --no-cache

start: ## sail のコンテナスタート
	./vendor/bin/sail up -d

stop: ## sail のコンテナストップ
	./vendor/bin/sail down

shell: ## shell
	./vendor/bin/sail shell
