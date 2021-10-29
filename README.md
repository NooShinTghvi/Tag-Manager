# Tag Manager

This is simple implementation of tag manager. you can store, show, index and destroy tags. pivot table is based on polymorphism.
There are two simple entity (Article and Product) For testing.


#  Getting started

- Install dependencies
  > composer install
  
- Create .env file and 
  > cp .env.example .env

- Generate the application key
    > php artisan key:generate

- Migration
    create a  db in database, complete  `DB_USERNAME`  &  `DB_PASSWORD` in **.env**
  > php artisan migrate

- To create the symbolic link
  >php artisan storage:link
  
- Launch the server
  >php artisan serve
  > 
  complete `APP_URL` in **.env**

- Run test
  > php artisan test
  
- Seeder
  > php artisan db:seed
------------------------------

> **Note:**  There is json File for testing with Postman:
> *Tag manager.postman_collection.json*
