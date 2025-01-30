# Usa una imagen de PHP con Apache
FROM php:8.2-apache

# Copia el código de tu aplicación al servidor
COPY . /var/www/html/

# Expone el puerto 80
EXPOSE 80

# Inicia Apache al arrancar el contenedor
CMD ["apache2-foreground"]
