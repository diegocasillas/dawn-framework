<p align="center">
  <img width="150" src="https://i.imgur.com/S7kzAwk.png">
  <h1 align="center">Dawn</h1>
</p>

* [Feature list](#feature-list)
* [Upcoming features](#upcoming-features)
* [Get started](#get-started)

<hr>


## What is this?
Well, right now it's just work in progress. I'm aiming to build a light MVC PHP framework from scratch that can be used to write web applications or APIs.

## There are amazing frameworks already. Stop wasting your time!
I know. I'm doing this for myself. I want to learn!

I started learning Laravel and I realized that I didn't have a clue of how everything was working. I wanted to understand the magic behind it, so I decided to write my own little Laravel.

## Okay, that makes sense. How are you doing it?
Reading a lot of resources and even more source code lines. Mostly I'm using Laravel as a reference, but I'm also doing my own thing here and there.

I'm trying to make it as clean as I can, but I'm already planning on doing a full refactor when the bedrock is ready.

## I can already see many security flaws.
Yep, I can see them too. I'm slowly working on it, this will be a long-term project. Any help or advices are welcome!

<hr>

# Feature list

* Authentication
  - Really simple cookie authentication implemented. Passwords are not even hashed yet. I'll work on authentication via token.
  
* Routing
  - Routes can easily be created and protected for guests, authenticated users or resource's owners (i.e you can make that only you can access your own profile).
    * You can add your own rules (friends, groups, roles...).
  - REST API ready, kinda.
  
* Redirections
  - If the user accesses an unauthorized resource, he/she/it/they will be redirected.
  
# Upcoming features

* JSON responses (with status code and additional info).
* Token authentication.
* Validation.

<hr>

# Get started

### Database configuration
- Configure your database settings in *global.php*:
    
```php
define('DB_NAME', 'miniframework');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_CONNECTION', 'mysql:host=127.0.0.1');

define('PUBLICFOLDER', '/miniframework/public');
```

- You will need to create the users table manually:

```sql
CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL DEFAULT '0',
    `password` VARCHAR(100) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `username` (`username`)
)
```

### Routes configuration
* Establish your routes in *core/routes.php*. Use ```Router::get()``` and ```Router::post()```.

  * Arguments:
    * Route string (from index)
    * Controller name
    * Action name
  
You can call the method ```auth()``` to authorize different users. Arguments can be: ```'guest'```, ```'authenticated'``` or ```'owner'```.

```php
Router::get('miniframework/login', 'LoginController', 'showLoginForm')->auth('guest');
```

### Write your app!
* Now you can write your own models, views and controllers and make your own app!
