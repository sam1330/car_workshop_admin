FROM shinsenter/laravel:latest

COPY .env ./.env
COPY .env.example ./.env
COPY . .

RUN rm -rf /var/www/html/node_modules
RUN rm -rf /var/www/html/vendor

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y nodejs \
    npm


RUN composer install --ignore-platform-reqs

RUN chown -R root:root /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

RUN php artisan storage:link

RUN npm install

EXPOSE 8000