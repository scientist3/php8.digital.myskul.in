#  This file is not need as i have 2 seperate files for that
# # Use the official PHP image with the desired PHP version
# FROM php:7.4-apache

# # Set the working directory to /var/www/html
# WORKDIR /var/www/html

# # Copy the CodeIgniter project files into the container
# COPY . /var/www/html

# # Install required PHP extensions
# RUN docker-php-ext-install mysqli

# # Install Xdebug 2.x extension (compatible with PHP 7.x)
# RUN pecl install xdebug-2.9.8 \
#     && docker-php-ext-enable xdebug

# # Set Xdebug configuration options
# RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# # Set PHP configuration (if needed)
# COPY php.ini /usr/local/etc/php/conf.d/

# # Enable mod_rewrite for the Apache server
# RUN a2enmod rewrite

# # Expose port 80 to access the web server
# EXPOSE 80

# # Start Apache server when the container runs
# CMD ["apache2-foreground"]
