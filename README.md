<p align="center">
  <img width="150" src="https://i.imgur.com/S7kzAwk.png">
  <h1 align="center">Dawn</h1>
</p>

* [Feature list](#feature-list)
* [Upcoming features](#upcoming-features)
* [Get started](#get-started)
* [License](#license)

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
  - Really simple cookie authentication implemented with JWT.
  
* Routing
  - Routes can easily be created and protected for guests, authenticated users or resource's owners (i.e you can make that only you can access your own profile).
    * You can add your own rules (friends, groups, roles...).
  - REST API ready, kinda.
  
* Redirections
  - If the user accesses an unauthorized resource, he will be redirected.

* JSON responses (with status code and additional info).

# Upcoming features
* Validation.
* Admin panel to manage routes.
* Unit tests.
* Documentation.

<hr>

# Installation

## Requirements

Dawn has the following requirements:

* PHP 7.2.4 or newer
** PDO Extension
* MySQL
* Apache 2.4

Note that it might work under older versions, but it has not been tested.

## Installing

`git clone https://github.com/diegocasillasdev/dawn.git` in the desired folder.

`cd dawn && cp example.env .env`

Edit the _.env_ file with your settings:

```ini
APP_NAME="Dawn"
KEY="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
DB_NAME="dawn"
DB_USER="root"
DB_PASSWORD=""
DB_CONNECTION="localhost"
```

The key is used to encrypt passwords and generate the session token. It should be a random 32 characters long string. This step is very important to keep data secure.

Create a `users` table:

```sql
CREATE TABLE `users` (`
    ``id` INT(11) NOT NULL AUTO_INCREMENT,`
    ``username` VARCHAR(50) NOT NULL DEFAULT '0',`
    ``password` VARCHAR(100) NOT NULL DEFAULT '0',`
    `PRIMARY KEY (`id`),`
    `UNIQUE INDEX `id` (`id`),`
    `UNIQUE INDEX `username` (`username`)`
`)
```

The code below is just an example. You can create the table as you wish. However, Dawn expects it to have those columns. If you want to modify them, you will need to edit the User and Auth classes.

### Configure session

Dawn offers 3 ways to handle sessions: cookie, php session and local storage.

Edit _config.php_ with your desired settings:

```php
'session' => [
    'mode' => 'cookie', // 'cookie', 'session' or 'local storage'
    'expires' => 864000 // in seconds
],
```

## Get started

### Routes configuration
* Establish your routes in *app/routes/web.php* or *app/routes/api.php*. Use ```$this::get()``` and ```$this::post()```.

  * Arguments:
    * Route string (from index)
    * Controller name
    * Action name
  
You can call the method ```auth()``` to authorize different users. Arguments can be: ```'guest'```, ```'authenticated'``` or ```'owner'```.

```php
$this::get('miniframework/login', 'LoginController', 'showLoginForm')->auth('guest');
```

### Write your app!
* Now you can write your own models, views and controllers and make your own app!

# License
Dawn is under [MIT License](https://github.com/diegocasillasdev/dawn/blob/master/LICENSE)
