FROM php:8.0-apache

# Instalar la extensión mysqli (para MySQL)
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite si un día lo necesitas
RUN a2enmod rewrite

# Copiar php.ini custom (opcional)
COPY php.ini /usr/local/etc/php/

# Copiar tu proyecto al servidor Apache del contenedor
COPY ../ /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html
