<p align="center">
  <img width="150" src="https://i.imgur.com/S7kzAwk.png">
  <h1 align="center">Dawn</h1>
</p>

* [Feature list](#feature-list)
* [Upcoming features](#upcoming-features)
* [Get started](#get-started)
* [Directory structure](#directory-structure)
* [Architecture](#architecture)
  * [Request lifecycle](#request-lifecycle)
  * [Application container](#application-container)
  * [Service providers](#service-providers)
* [Working with Dawn](#working-with-dawn)
  * [Routing](#routing)
  * [Request](#request)
  * [Response](#response)
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
  * PDO Extension
* MySQL
* Composer
* Apache 2.4

Note that it might work under older versions, but it has not been tested.

## Installing

`git clone https://github.com/diegocasillasdev/dawn.git` in the desired folder.

`cd dawn && composer install`

`cp example.env .env`

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
    ``email` VARCHAR(50) NOT NULL DEFAULT '0',`
    ``password` VARCHAR(100) NOT NULL DEFAULT '0',`
    `PRIMARY KEY (`id`),`
    `UNIQUE INDEX `id` (`id`),`
    `UNIQUE INDEX `email` (`email`)`
`)
```

The code above is just an example. You can create the table as you wish. However, Dawn expects it to have those columns (`id`, `email` and `password`). If you want to modify them, you will need to edit the User and Auth classes.

### Configure session

Dawn offers 3 ways to handle sessions: cookie, php session and local storage.

Edit _config.php_ with your desired settings:

```php
'session' => [
    'mode' => 'cookie', // 'cookie', 'session' or 'local storage'
    'expires' => 864000 // expiry time in seconds
],
```

# Get started

## Routes configuration
* Establish your routes in *app/routes/web.php* or *app/routes/api.php*. Use ```$this::get()``` and ```$this::post()```.
  * Arguments:
    * URI
    * Controller name
    * Action name
  
You can call the method ```auth()``` to authorize different users. Arguments can be: ```'guest'```, ```'authenticated'``` or ```'owner'```.

```php
$this::get('miniframework/login', 'LoginController', 'showLoginForm')->auth('guest');
```

## Write your app!
* Now you can write your own models, views and controllers and make your own app!

# Directory structure

* [`[app]`](#app)
  * [`[controllers]`](#appcontrollers)
  * [`[models]`](#appmodels)
  * [`[routes]`](#approutes)
    * [`web.php`](#approuteswebphp)
    * [`api.php`](#approutesapiphp)
  * [`[views]`](#appviews)
* [`[Dawn]`](#dawn-1)
* [`[docs]`](#docs)
* [`[tests]`](#tests)
* [`[vendor]`](#vendor)
* [`.env`](#env)
* [`.gitignore`](#gitignore)
* [`.htaccess`](#htaccess)
* [`composer.json`](#composerjson-and-composerlock)
* [`composer.lock`](#composerjson-and-composerlock)
* [`config.php`](#configphp)
* [`example.env`](#exampleenv)
* [`index.php`](indexphp)

## `app`

Contains your application. This folder is pretty much the only thing you need to care about.

### `app/controllers`

Contains your own application controllers. They should belong to the `App\Controllers` namespace and extend from `App\Controllers\Controller`.

### `app/models`

Contains your own data access models. They should belong to the `App\Models` namespace and extend from `App\Models\Model`.

### `app/routes`

Contains your defined application routes.

#### `app/routes/web.php`

Contains your web endpoint routes.

#### `app/routes/api.php`

Contains your API endpoint routes.

### `app/views`

Contains your application view files.

## `Dawn`

Dawn Framework folder. Contains all the necessary classes, services and tools for the framework to work. You won't need to worry about this folder.

## `docs`

Contains the documentation website files.

## `tests`

You should write your tests here.

## `vendor`

Composer dependencies folder.

## `.env`

Environmental file for sensitive data. It doesn't exist by default, you need to copy it from `example.env`. **DON'T COMMIT THIS FILE.**

## `.gitignore`

You can write here the path to the files that you don't wanna include in your repository.

## `.htaccess`

Apache configuration file.

## `composer.json` and `composer.lock`

Composer package manager files.

## `config.php`

Contains your application settings, such as session, database or service providers.

## `example.env`

Example for `.env` file.

## `index.php`

Entry point for the application. You won't need to worry about this file either.


# Architecture

* [Request lifecycle](#request-lifecycle)
* [Application container](#application-container)
* [Service providers](#service-providers)

## Request lifecycle

The entry point for all request is `index.php`. All request are directed to this file by Apache.

In `index.php`, Dawn is bootstrapped. This means that the application is loaded with the configuration and service providers. When it is ready, the application is run.

Next, the *Router* service handles the request, processing it, finding what route was requested by the user and directing it to the *Controller Dispatcher* service.

The *Controller Dispatcher* is in charge of creating a new instance of the *Controller* that needs to handle the request, and preparing it to call the requested action.

Finally, the *Controller* delegates momentarily the request to the *Middleware*, which will verify that everything is in order (authentication, authorization...). After it, the *Controller* does its job and sends a response back. 

## Application container

Dawn's application container contains everything necessary for the application to work. It is implemented in `Dawn/App/App.php`.

The services are bound to it thanks to the *service providers*.

It's in charge of getting the application ready, running it and provide its bound services.

## Service providers

Service providers form the backbone of the framework. Dawn includes several service providers (routing, database, session...), but you can also write your own and easily integrate them in Dawn.

When the application is being bootstrapped, it means that it is registering and booting the service providers included in `config.php`.

Service providers require a `register` and `boot` method.

In the `register` method, the services are bound to the application container. It's called once for each service provider.

The `boot` method is called after every service has been registered. Here, each service provider does the necessary tasks to get its services ready.


# Working with Dawn

## Routing

* [Adding routes](#adding-routes)
* [Protecting routes](#protecting-routes)


Routing is handled by Dawn's routing service. It includes a router to handle the request and response, custom routes and a base controller.

### Adding routes

Routes are set in `app/routes/web.php` and `app/routes/api.php`.

To add a route, simply call the `get`, `post`, `patch`, `put` or `delete` method of the `Dawn\Routing\Router` class.

These methods expect the following parameters:

Parameter        |                            | Example
---------------- | -------------------------- | ------------
**`uri`**        | URI requested by the user. | *The login route is `www.example.com/login`. Therefore, the URI is `login`.*
**`controller`** | The controller's name that will handle the request. A valid Dawn controller belongs to the `App\Controller` namespace. The controller name must be the rest of the namespace.                        | *`LoginController`'s full name is `App\Controllers\Auth\LoginController`. Therefore, the controller name must be `Auth\LoginController`.*
**`action`**     | The controller's method name that will handle the request.                           | *The method `LoginController->showLoginForm()` is in charge of showing a login form view. Therefore, the action is `showLoginForm`.*


```php
$this->get('login', 'Auth\LoginController', 'showLoginForm');
```

### Protecting Routes

Routes can be protected thanks to Dawn's auth service. This will restrict access to users that don't have the required permissions.

By default, routes are available for all users. Dawn offers the possibility to restrict access to only guests (`guest`), only authenticated users (`auth`) and only owners of the resource (`owner`).

To protect a specific route, simply call the `auth` method on it with the restriction parameter.

```php
$this->get('login', 'Auth\LoginController', 'showLoginForm')->auth('guest');
```


## Request

* [Accessing request's input](#accessing-requests-input)
* [Checking if a input value is empty](#checking-if-a-input-value-is-empty)
* [Obtaining request's IP address and User Agent](#obtaining-requests-ip-address-and-user-agent)

The current request is accessible from the router and the controller handling it.

### Accessing request's input

The request's input can be accessed with the controller's `input` method:

```php
class LoginController extends AuthController
{
  public function credentials()
  {
    $credentials = $this->input();

    return $credentials;
  }
}
```

A single input value can also be accessed passing its key as parameter to the `input` method:

```php
class LoginController extends AuthController
{
  public function email()
  {
    $email = $this->input('email');

    return $email;
  }
}
```


### Checking if a input value is empty

Checking if a input value is empty can be done with the `empty` method:

```php
class LoginController extends AuthController
{
  public function email()
  {
    if ($this->empty('remember')) {
      return "The email can't be empty.";
    }
    
    $email = $this->input('email');
    
    return $email;
  }
}
```


### Obtaining request's IP address and User Agent

The IP address and User Agent can be accessed from the controller's `ip` and `userAgent` methods.

```php
class LoginController extends AuthController
{
  public function requestInfo()
  {
    $ip = $this->ip();
    $userAgent = $this->userAgent();

    return "IP Address: {$ip] - User Agent: {$userAgent}";
  }
}
```

## Response

* [Sending a simple response](#sending-a-simple-response)
* [Sending a full response](#sending-a-full-response)

### Sending a simple response

To send a simple response, simply return a value or a view.

```php
class LoginController extends AuthController
{
  public function showLoginForm()
  {
    return view('auth/login');
  }
}
```

### Sending a full response

* [Setting a status code](#setting-a-status-code)
* [Adding headers](#adding-headers)
* [Adding a authentication token header](#adding-a-authentication-token-header)
* [Adding data](#adding-data)
* [JSON response](#json-response)
* [Using the controller's response method](#using-the-controllers-response-method)

Dawn includes a Response class (`Dawn\Routing\Response`) that allows to send responses headers, cookies and other data attached.

This can be done with the controller's `response` property and `response` method. Different methods can be chained and once the response is ready it can be sent with its `send` method.

#### Setting a status code

Setting a status code can be easily done with the response's `status` method.

This method expects the following parameters:

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`code`**                 | Status code (integer number). | *The resource was not found, therefore the most suitable status code is `404`.*
**`message`** *[optional]* | Custom status message. If a status message is not passed to the method, Dawn will try to find the message corresponding to the status code.                                                               | *The status code is `404`, so the status message will be `Not Found` unless it is overriden.*


```php
class LoginController extends AuthController
{
  public function notFound()
  {
    return $this->response->status('404')->send();
  }
}
```


#### Adding headers

Headers can be added with the response's `header method`.

It expects the following parameters: 

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`name`**                 | The name of the header. | *To send a cookie with the response, the `Set-Cookie` header is needed. Therefore, the header name is `Set-Cookie`.*
**`value`** | The value of the header.                                                               | *Cookie's name is `color` and its value is `red`. Therefore, the header value is `color=red`.*

```php
class LoginController extends AuthController
{
  public function addColor()
  {
    return $this->response->header('Set-Cookie', 'color=red')->send();
  }
}
```


#### Adding a authentication token header

Token headers can be added with the response's method `token`.

```php
class LoginController extends AuthController
{
  public function addToken()
  {
    return $this->response->token('xxxxxxxxxxxxxxxxxx')->send();
  }
}
```

#### Adding data

Data can be added to the response with its `data` method.

```php
class LoginController extends AuthController
{
  public function addData()
  {
    $data = [
      'current_users': 2000,
      'max_users': 2500
    ];

    return $this->response->data($data)->send();
  }
}
```

#### JSON response

JSON responses can be send with the response's `json` method.

```php
class LoginController extends AuthController
{
  public function sendJson()
  {
    $data = [
      'current_users': 2000,
      'max_users': 2500
    ];

    return $this->response->data($data)->json()->send();
  }
}
```

#### Using the controller's response method

Responses can also be sent using the controller's `response` method.

It expects the following parameters: 

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`data`**                 | The data to be sent with the response. | *The data contained in the `$data` array. Therefore, `data` parameter is `$data`.*
**`statusCode`** *[optional]* | The status code of the response. If it is not passed to the method, it will be `200`.                                                               | *The status code is `200`. Therefore, it is not needed to pass it to the method.*


```php
class LoginController extends AuthController
{
  public function sendJson()
  {
    $data = [
      'current_users': 2000,
      'max_users': 2500
    ];

    return $this->response($data)->json()->send();
  }
}
```

# License
Dawn is under [MIT License](https://github.com/diegocasillasdev/dawn/blob/master/LICENSE).
