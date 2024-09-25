# Instrucciones de ejecucion

## Requerimientos

-   PHP (v8.0 o superior)
-   MySQL (v8.0 o superior)
-   Composer (v2.5 o superior)

## Pasos a seguir

1. Clonar el repositorio del proyecto

```bash
git clone https://github.com/matiasgimenezdev/songhub
```

2. Instalar las dependencias necesarias

```bash
composer install
```

3. Clonar el archivo .env.example y renombrarlo a .env. Dentro del archivo generado, configurar los valores para las variables de entorno.

```
# Ver niveles de log admitidos por Monolog
# https://seldaek.github.io/monolog/doc/01-usage.html#log-levels
LOG_LEVEL = DEBUG

# Path relativo a la raiz del proyecto donde se quieren resguardar los archivos de logs
LOG_PATH = "logs/app.log"

# Configuración de la base de datos
DB_ADAPTER = mysql
DB_HOSTNAME = localhost
DB_USERNAME = root
DB_PASSWORD =
DB_NAME = songhub
DB_CHARSET = utf8
DB_PORT = 3306

# Generar CLIENT ID de la aplicación en https://developer.spotify.com/dashboard/applications. Ahí mismo se puede obtener la clave secreta.
SPOTIFY_CLIENT_ID=
SPOTIFY_CLIENT_SECRET=
```

4. Configurar la variable $PATH para incluir composer. Si se encuentra en Linux, ejecutar el siguiente comando:

```bash
export PATH=$PATH:~/.config/composer/vendor/bin
```

5. Crear la base de datos con el nombre utilizado en la variable de entorno DB_NAME. Puede loguearse en su usuario de MySQL y ejecutar el siguiente comando en la CLI.

```bash
CREATE DATABASE <DB_NAME>
```

Como alternativa, si posee docker instalado puede utilizar docker-compose para iniciar el contenedor MySQL:

```bash
docker-compose up -d
```

6. Ejecutar la migration de la base de datos

```bash
phinx migrate -e development
```

7. Levantar el servidor standalone

```bash
php - S localhost:8000 -t public/
```
