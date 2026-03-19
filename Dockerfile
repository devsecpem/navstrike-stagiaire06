FROM php:8.1.0


RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

RUN chown -R www-data:wwww-data /var/www/html/

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s \
	CMD curl -f http://localhost/ || exit 1



CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html/"]
