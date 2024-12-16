# Dockerfile
FROM php:8.3-cli
WORKDIR /app

# Install dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Copy your project files to the container
COPY . .

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php && php composer.phar install
