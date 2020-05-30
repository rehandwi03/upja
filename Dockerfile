FROM php:7
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN docker-php-ext-install pdo mbstring
WORKDIR /app
COPY . /app
RUN composer install
RUN cp .env.example .env
RUN sed -i 's/db_host/172.17.0.1/g' .env
RUN sed -i 's/db_name/upja/g' .env
RUN sed -i 's/db_user/root/g' .env
RUN sed -i 's/db_password/P@ssw0rd/g' .env
RUN php artisan key:generate

CMD php -S 0.0.0.0:8080 -t public
EXPOSE 8080