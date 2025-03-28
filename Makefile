.PHONY: up down start stop container restart build logs ps docker-clean

CONTAINER_NAME=mvc-base

up:
	docker-compose up -d

start:
	docker-compose start

stop:
	docker-compose stop

container:
	docker-compose exec $(CONTAINER_NAME) bash

restart:
	docker-compose restart

down:
	docker-compose down

build:
	docker-compose build

logs:
	docker-compose logs -f $(CONTAINER_NAME)

ps:
	docker-compose ps

docker-clean:
	docker rm -f $(CONTAINER_NAME) || true
	docker rmi -f $(shell docker images -q $(CONTAINER_NAME)) || true
	docker volume prune -f
	docker network prune -f
	docker system prune -f
	docker builder prune -f