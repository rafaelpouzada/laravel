FROM rafaelpouzada/laravel-image:latest
CMD service php8.0-fpm start && nginx -g "daemon off;"
