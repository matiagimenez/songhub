# Instrucciones de ejecucion

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
```

4. Levantar el servidor standalones

```
php - S localhost:8000 -t public/
```
