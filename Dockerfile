# Usa la imagen oficial de PHP con Apache
FROM php:8.0-apache

# Copia el contenido de la aplicación a la carpeta raíz del servidor web en el contenedor
COPY . /var/www/html/

# Otorga permisos y cambia el propietario de los archivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Actualiza la configuración de Apache para permitir el acceso a /var/www/html
RUN echo "<Directory /var/www/html/> \n\
    Options Indexes FollowSymLinks \n\
    AllowOverride All \n\
    Require all granted \n\
    DirectoryIndex login.php \n\
    </Directory>" > /etc/apache2/conf-available/app.conf \
    && a2enconf app

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Instala las extensiones necesarias para conectar PHP con MySQL
RUN docker-php-ext-install mysqli
