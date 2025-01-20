# Base PHP image
FROM php:8.3-cli

# Set working directory inside the container
FROM php:8.3-cli
WORKDIR /app

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Copy your project files into the container
COPY . .
