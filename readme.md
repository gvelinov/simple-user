## Simple User management system

This is a simple web app for user management, written on Laravel. It allows user management 
with initial RBAC functionality. There are two ways to start the app - 
using docker-compose or manually (on configured LAMP). As a requirements - PHP7, Apache 2.4, MySQL 5.7.

#### Running with Docker
1. You need docker and docker-compose and composer installed
2. Copy _.env.example_ to _.env_
3. In the root dir run ```composer install```
4. Run ```docker-compose build```
5. Then ```docker-compose up -d```
6. Ensure the containers are running with ```docker ps```
7. Access the app container with ```docker exec -ti {container name} /bin/bash```
where {container name} should be similar to _...app_1_ depending on the location of the project (_docker ps_ will show the container name).
8. When you are in the container run 
```php artisan migrate:refresh --seed```
9. Access the app on localhost:8080 (or some IP instead of localhost, depending on the docker host OS).


#### Running on LAMP
1. You need installed and configured LAMP and composer
2. Copy _.env.example_ to _.env_
3. Edit _.env_ setting for the DB connection (database name, user, pass, host, port - make sure they exist).
4. Now, run ```composer install``` 
5. Create the db schema and insert some test data with
```php artisan migrate:refresh --seed```.  

Note: the _storage_ directory could have wrong permissions, if so change them so Apache can read/write to it (you will see an error if you have to do it).

#### Available user for login and data
When the app is up and running you can use the user _demo@demo.com_ with pass _Changeme1_  
There are two roles - _manager_ and _staff_. And some predefined permissions for _manager_ and _staff_ capabilities.  
When you are _manager_ after login you are able to see a menu item _Users_ from where user management could be done.

