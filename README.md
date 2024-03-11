# Admin Panel

## Project setup
```
docker-compose up -d vue
```

## Install Laravel inside container
```
docker-compose run --rm composer install
```

## Copy .env.example file to .env
```
cp laravel/.env.example laravel/.env
```

## Generate the app key
```
docker-compose run --rm artisan key:generate
```

## Run migration inside container
```
docker-compose run --rm artisan migrate --seed
```

## To access any container's file system
```
docker exec -it {container_name} sh
```
