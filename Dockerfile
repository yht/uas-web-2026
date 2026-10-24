# Image untuk UAS Web (Data Mahasiswa, PHP + SQLite)
FROM php:8.2-cli

# Ekstensi PDO SQLite sudah ada di image php resmi; pastikan saja
RUN php -m | grep -qi "pdo_sqlite" || docker-php-ext-install pdo

WORKDIR /var/www/app
COPY . /var/www/app

# Database SQLite harus bisa ditulis oleh PHP
RUN mkdir -p /var/www/app/database \
 && touch /var/www/app/database/database.sqlite \
 && chown -R www-data:www-data /var/www/app/database

ENV PORT=8001
EXPOSE 8001

# Router: semua request diarahkan ke public/index.php
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t public public/index.php"]
