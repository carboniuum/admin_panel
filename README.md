# Admin Panel

## Project setup
```
docker-compose up -d vue
```

## To install laravel inside container
```
docker-compose run --rm composer install
```

## To run migration inside container
```
docker-compose run --rm artisan migrate
```

## To access any container's file system
```
docker exec -it {container_name} sh
```
