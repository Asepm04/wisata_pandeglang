# Gunakan image resmi PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install dependensi sistem yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Salin file aplikasi ke direktori kerja container
COPY . /var/www/html

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Ubah document root Apache ke direktori public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Sesuaikan konfigurasi Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Berikan permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Jalankan perintah build Laravel jika diperlukan
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN php artisan config:cache


# Port default Apache
EXPOSE 80

CMD sh -c php -S 0.0.0.0:8080 -t public