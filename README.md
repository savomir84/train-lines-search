## How to install and run

1. clone repository from Github (https://github.com/savomir84/train-lines-search)
2. create database and adjust .env file (DB_DATABASE, DB_USERNAME i DB_PASSWORD(line 13, line 14 and line 15))
3. open command prompt
4. navigate to the cloned project on your localhost
5. run "php artisan migrate" (this command runs database migration)
6. run "php artisan db:seed" (this command runs database seeding)
7. run "php artisan serve"
8. open "http://127.0.0.1:8000/" in your browser