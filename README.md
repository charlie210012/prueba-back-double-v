## Instalacion sin docker

1. Clona el repositorio https://github.com/charlie210012/prueba-back-double-v.git

2. ve a la raiz de proyecto y Corre el comando composer install

3. Corre el comando php artisa migrate 

4. Corre los comandos  
   php artisan lighthouse:ide-helper
   php artisan vendor:publish --provider="Nuwave\Lighthouse\LighthouseServiceProvider"
    php artisan lighthouse:print-schema > schema.graphql


Nota: Asegurate de modificar el .env para la configuracion de tu base de datos

## Instalar con Docker

1. Clona el repositorio https://github.com/charlie210012/prueba-back-double-v.git

2. Asegúrate de tener Docker instalado en tu sistema. Puedes verificarlo ejecutando `docker version` en tu terminal para obtener información sobre la instalación de Docker. 

3. Navega hasta el directorio donde se encuentran los archivos Docker del proyecto. 

4. Ejecuta el comando `docker-compose up -d` en tu terminal para crear e iniciar los contenedores definidos en el archivo docker-compose.yml. El flag `-d` permite que los contenedores se ejecuten en segundo plano. 

5. Espera a que Docker descargue las imágenes necesarias y configure los contenedores. El tiempo que lleva este proceso puede variar según el tamaño de las imágenes y el rendimiento de tu conexión a internet. 


