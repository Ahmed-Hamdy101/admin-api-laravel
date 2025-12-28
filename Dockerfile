# Use PHP 8.2 instead of 8.1
FROM php:8.2-apache

# Install packages & extensions
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql  # Combined RUN layers

# Install Composer securely
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    --version=2.5.8  # Pinned version for stability
# Create Dir called App
WORKDIR /app

# Copy only composer files first for dependency caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts  # Use install NOT update for production

# Copy application files
COPY . .
# Set permissions for storage and bootstrap/cache directories
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
# map it localhost of ours
EXPOSE 8000
