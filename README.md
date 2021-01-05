## How to install and run

1. clone repository from Github (https://github.com/savomir84/train-lines-search)
2. copy .env.example file and set copy name to be .env
3. create database and adjust .env file accordingly (DB_DATABASE, DB_USERNAME i DB_PASSWORD(line 13, line 14 and line 15))
4. open command prompt
5. navigate to the cloned project on your localhost
6. run "composer update"
7. run "php artisan migrate" (this command runs database migration)
8. run "php artisan db:seed" (this command runs database seeding)
9. run "php artisan key:generate"
10. run "php artisan serve"
11. open "http://127.0.0.1:8000/" in your browser