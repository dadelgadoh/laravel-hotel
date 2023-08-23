# ![Laravel Example App](logo.png)

[![Build Status](https://img.shields.io/travis/gothinkster/laravel-realworld-example-app/master.svg)](https://travis-ci.org/gothinkster/laravel-realworld-example-app) [![Gitter](https://img.shields.io/gitter/room/realworld-dev/laravel.svg)](https://gitter.im/realworld-dev/laravel) [![GitHub stars](https://img.shields.io/github/stars/gothinkster/laravel-realworld-example-app.svg)](https://github.com/gothinkster/laravel-realworld-example-app/stargazers) [![GitHub license](https://img.shields.io/github/license/gothinkster/laravel-realworld-example-app.svg)](https://raw.githubusercontent.com/gothinkster/laravel-realworld-example-app/master/LICENSE)

> ### Restfull Api para gestión hotelera con  [cliente en Vue.Js](https://github.com/dadelgadoh/vue-hotel).

Aplicación restfull para getión de hoteles, y de capacidad de habitaciones global, de acuerdo al hotel, tipo de habitación y acomodacion disponible.
----------

# Implementación

## Instalación

PHP 8.1

La instalación alternativa es posible sin depender de las dependencias locales, utilizando  [Docker](#docker). 

Clonar repositorio:

    git clone git@github.com:dadelgadoh/laravel-hotel.git

Cambiar al directorio del repo

    cd laravel-hotel

Instala todas las dependencias utilizando Composer

    composer install

Copia el archivo de ejemplo de configuración (.env.example) y realiza los cambios de configuración necesarios en el archivo .env

    cp .env.example .env

Ejecuta las migraciones y precarga la db de la base de datos (**Configura la conexión de la base de datos en .env antes de ejecutar las migraciones**) La db es en Postgres Sql, y su dump se encuentra en el repositorio ./dump_hotel.

    php artisan migrate:fresh --seed

Inicia el servidor de desarrollo local

    php artisan serve

Puebe acceder al API aqui: [http://localhost:8000/api/v1/](http://localhost:8000/api/v1/).


    
## Docker


Para instalar utilizando  [Docker](https://www.docker.com), ejecuta los siguientes comandos:

```
docker pull diedel1296/hotelapi
docker run -it --rm -v $(pwd):/app diedel1296/hotelapi bash
cp .env.example.docker .env
composer install
php artisan key:generate
php artisan jwt:generate
php artisan migrate
php artisan db:seed
php artisan serve --host=0.0.0.0
exit

```

Puebe acceder al API aqui: [http://localhost:8000/api/v1/](http://localhost:8000/api/v1/).

## API

### Hoteles

#### Listado de hoteles

Retorna una lista de los hoteles disponibles.

- URL: api/v1/hotels
- Método: GET
- Controlador: Api\V1\HotelController@index

#### Detalle de hotel 
---------


### Habitaciones de hotel

#### Listado de configuraciones de habitaciones

Retorna una lista de los hoteles disponibles.

- URL: api/v1/hotel-rooms
- Método: GET
- Controlador: Api\V1\HotelRoomTypeController@index
----------

# Codigo

## Folders

- `app` - Contiene todos los modelos de Eloquent
- `app/Http/Controllers/Api/V1` - Contiene todos los controladores de la API
- `app/Http/Requests` - Contiene todas las solicitudes de formulario de la API
- `app/Http/Resourses/v1` - Contiene todos las definiciones de recursos de la API
- `config` - Contiene todos los archivos de configuración de la aplicación
- `database/migrations` - Contiene todas las migraciones de la base de datos
- `database/seeds` - Contiene el precargador de la base de datos
- `routes` -  Contiene todas las rutas de la API definidas en el archivo api.php
- `tests` - Contiene todas las pruebas de la aplicación

