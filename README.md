# Prex Challenge

### Setup

1. Clonar el proyecto
2. Instalar dependencias con el siguiente commando
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
1. Levantar el proyecto con
```shell
vendor/bin/sail up -d
```
2. Ejecutar tests unitarios con `sail test --coverage`
3. Utilizar [coleccion de Postman](./documentation/prex-hallenge.postman_collection.json) y [environment](./documentation/prex-challenge.postman_environment.json) para probar los endpoints
