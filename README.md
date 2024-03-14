# Prex Challenge

### Setup

1. Clonar el proyecto
2. Instalar dependencias y configurar con el siguente script
```shell
docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v "$(pwd):/var/www/html" \
   -w /var/www/html \
   laravelsail/php83-composer:latest \
   composer install --ignore-platform-reqs
```
3. Editar archivo `.env` y completar la variable `GIPHY_KEY`

### Ejecucion
1. Levantar el proyecto y ejecutar
```shell
vendor/bin/sail up -d
vendor/bin/sail shell

# adentro del container
php artisan key:generate
php artisan migrate --seed
```
2. Ejecutar tests unitarios con `sail test --coverage`
3. Utilizar [coleccion de Postman](./documentation/prex-hallenge.postman_collection.json) y [environment](./documentation/prex-challenge.postman_environment.json) para probar los endpoints. Revisar puerto del environment en caso de cambiarlo.
4. Los logs de los servicios se guardan en `storage/logs/laravel.log`, en produccion esto debe ser guardado por un servicio externo (CloudWatc, DataDog, Grafana Loki, etc) siguiendo los principios de [12th factor app](https://12factor.net/es/)
5. Finalizar y limpiar todo con `vendor/bin/sail down -v`

### Documentacion

Ver en [Documentacion](./documentation/documentation.md)
