# Use the official PHP image with the desired PHP version
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the CodeIgniter project files into the container
COPY . /var/www/html

# Install required PHP extensions
RUN docker-php-ext-install mysqli

# Enable mod_rewrite for the Apache server
RUN a2enmod rewrite

# Expose port 80 to access the web server
EXPOSE 80

# Start Apache server when the container runs
CMD ["apache2-foreground"]
