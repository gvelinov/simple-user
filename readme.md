## Simple User management system

This is a simple web app for user management, written on Laravel. It allows user management 
with initial RBAC functionality. There are two ways to start the app - 
using docker-compose or manually (on configured LAMP). As a requirements - PHP7, Apache 2.4, MySQL 5.7.

#### Running with Docker
1. You need docker and docker-compose installed
2. Copy _.env.example_ to _.env_
3. Run ```docker-compose build```
4. Then ```docker-compose up -d```
5. Ensure the containers are running with ```docker ps```
6. Then run ```docker exec {container name} php ../composer.phar install``` 
where container name is something with _..._app_1_ (form step 5 you should've seen the container's name).
7. Then, run ```docker exec {container name} php artisan migrate:refresh --seed```
8. And in the end ```docker exec {container name} chown -R apache:apache storage```
9. Access the app on localhost:8080 (or some IP instead of localhost, depending on the docker host OS).


#### Running on LAMP
1. You need installed and configured LAMP and composer
2. Copy _.env.example_ to _.env_
3. Edit _.env_ setting for the DB connection (database name, user, pass, host, port - make sure they already exist).
4. Now, run ```composer install``` 
5. Create the db schema and insert some test data with
```php artisan migrate:refresh --seed```.  

Note:  
You could have an error for a permission in directory /var/www/html/storage..., 
in this case just change the owner to the Apache  user and group (read/write permissions).

#### Available user for login and data
When the app is up and running you can use the user _demo@demo.com_ with pass _Changeme1_  
There are two roles - _manager_ and _staff_. And some predefined permissions for _manager_ and _staff_ capabilities.  
When you are _manager_ after login you are able to see a menu item _Users_ from where user management could be done.

