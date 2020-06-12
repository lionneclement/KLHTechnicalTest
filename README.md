# KLHTechnicalTest
## Clone
1) Make a clone with `https://github.com/lionneclement/KLHTechnicalTest.git` and `cd KLHTechnicalTest`
2) Install composer with `composer install`
3) Create database with `php bin/console doctrine:database:create`
4) Create table with `php bin/console doctrine:schema:create`
5) Create data with `php bin/console doctrine:fixtures:load`

   By default a user was created with email=user@gmail.com password=password and an admin with email=admin@gmail.com password=password
   
6) Run server with `bin/console server:run` or `symfony server:start`and go to localhost with port 8000
7) To get all recipes of a user using Query like: http://localhost:8000/api/recipes?user={UserID}

Normally everything works, If you have a error or send me an mail to lionneclement@gmail.com or create a issue
