<p align="center">
  <img width="150" src="https://i.imgur.com/S7kzAwk.png">
  <h1 align="center">Dawn</h1>
</p>

* [Feature list](#feature-list)
* [Upcoming features](#upcoming-features)
* [Guía rápida](#guia-rapida)
* [Estructura de directorios](#estructura-de-directorios)
* [Arquitectura](#arquitectura)
  * [Ciclo de vida de la petición](#ciclo-de-vida-de-la-peticion)
  * [Contenedor de la aplicación](#contenedor-de-la-aplicacion)
  * [Proveedores de servicios](#proveedores-de-servicios)
* [Trabajando con Dawn](#trabajando-con-Dawn)
  * [Enrutamiento](#enrutamiento)
  * [Petición](#peticion)
  * [Respuesta](#respuesta)
  * [Base de Datos](#base-de-Datos)
  * [Autenticación](#autenticacion)
  * [Sesión](#sesion)
* [Licencia](#licencia)

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

# Instalación

## Requisitos

Dawn tiene los siguientes requisitos:

* PHP 7.2.4 o superior
  * Extensión PDO
* MySQL
* Composer
* Apache 2.4

Ten en cuenta que podría funcionar bajo versiones anteriores, pero no ha sido testeado.

## Instalar

`git clone https://github.com/diegocasillasdev/dawn.git` en el directorio deseado.

`cd dawn && composer install`

`cp example.env .env`

Edita el archivo `.env` con tus ajustes:

```ini
APP_NAME="Dawn"
KEY="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
DB_NAME="dawn"
DB_USER="root"
DB_PASSWORD=""
DB_CONNECTION="localhost"
```

La key es usada para encriptar contraseñas y generar el token de la sesión. Debería ser una cadena de 32 caracteres aleatorios. Este paso es muy importante para mantener los datos seguros.

Crea una tabla `users`:

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

El código de arriba es solo un ejemplo. Puedes crear la tabla como desees. Sin embargo, Dawn espera que tenga esas columnas (`id`, `email` and `password`). Si quieres modificarlas, tendras que editar las clases `App\Model\User` y `Dawn\Auth\Auth`.


### Configuración de la sesión

Dawn ofrece 3 maneras de manejar sesiones: cookie, sessión de PHP y local storage.

Edita `config.php` con tus ajustes deseados:

```php
'session' => [
    'mode' => 'cookie', // 'cookie', 'session' o 'local storage'
    'expires' => 864000 // tiempo de expiración en segundos
],
```

# Guía rápida

## Configuración de las rutas
* Establece tus rutas en *app/routes/web.php* o *app/routes/api.php*. Usa ```$this::get()``` y ```$this::post()```.
  * Parámetros:
    * URI
    * Nombre del controlador
    * Nombre de la acción
  
Puedes llamar el método ```auth()``` para autorizar diferentes usuarios. Los parámetros pueden ser: ```'guest'```, ```'authenticated'``` or ```'owner'```.

```php
$this::get('miniframework/login', 'LoginController', 'showLoginForm')->auth('guest');
```

## ¡Escribe tu aplicación!

* ¡Ahora puedes escribir tus propios controladores, modelos y vistas y hacer tu propia aplicación!


# Estructura de directorios

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

Contiene tu aplicación. Esta carpeta es la única de la que tienes que preocuparte.

### `app/controllers`

Contiene propios controladores de la aplicación. Deberían pertenecer al namespace `App\Controllers` y heredar de `App\Controllers\Controller`.

### `app/models`

Contiene tu propios modelos de acceso de datos. Deberían pertenecer al namespace `App\Models` y heredar de `App\Models\Model`.

### `app/routes`

Contiene tus rutas de la aplicación definidas.

#### `app/routes/web.php`

Contiene tus rutas para el punto de entrada web.

#### `app/routes/api.php`

Contiene tus rutas para el punto de entrada API.

### `app/views`

Contiene los archivos de las vistas de tu aplicación.

## `Dawn`

Carpeta de Dawn Framework. Contiene todas las clases, servicios y herramientas necesarias para que el framework funcione. No necesitas preocuparte por esta carpeta.

## `docs`

Contiene los archivos del website de documentación.

## `tests`

Deberías escribir tus tests aquí.

## `vendor`

Carpeta de dependencias de Composer.

## `.env`

Archivo de entorno para datos sensibles. No existe por defecto, necesitas copiarlo de `example.env`. **NO HAGAS COMMIT DE ESTE ARCHIVO.**

## `.gitignore`

Aquí puedes escribir la ruta de los archivos que no quieres incluir en tu repositorio.

## `.htaccess`

Archivo de configuración de Apache.

## `composer.json` and `composer.lock`

Archivos del administrador de paquetes Composer.

## `config.php`

Contiene los ajustes de tu aplicacion, tales como la sesión, base de datos o proveedores de servicios.

## `example.env`

Ejemplo para el archivo `.env`.

## `index.php`

Punto de entrada para la aplicación. Tampoco necesitas preocuparte por este archivo.


# Arquitectura

* [Ciclo de vida de la petición](#ciclo-de-vida-de-la-peticion)
* [Contenedor de la aplicación](#contenedor-de-la-aplicacion)
* [Proveedores de servicios](#proveedores-de-servicios)

## Ciclo de vida de la petición

El punto de entrada para todas las peticiones es `index.php`. Todas las peticiones son dirigidas a este archivo por Apache.

En `index.php`, Dawn es preparado. Esto significa que la aplicación es cargada con la configuración y los proveedores de servicios. Cuando esta listo, la aplicación es ejecutada. 

Despues, el servicio *Router* se encarga de la petición, procesandola, encontrando que ruta ha sido requerida por el usuario y dirigiendola al servicio *Controller Dispatcher*.

El *Controller Dispatcher* se encarga de crear una nueva instancia del *Controller* que necesita manejar la petición, y prepararlo para llamar la acción requerida.

Finalmente, el *Controller* delega momentáneamente la petición al *Middleware*, que verificará que todo está en orden (autenticación, autorización...). Despues de ello, el *Controller* hace su trabajo y manda una respuesta de vuelta.


## Contenedor de la aplicación

El contenedor de la aplicación de Dawn contiene todo lo necesario para que la aplicación funcione. Está implementado en `Dawn/App/App.php`.

Los servicios son enlazados a él gracias a los *proveedores de servicios*.

Está en cargo de preparar la aplicación, ejecutarla y proveer sus servicios enlazados.


## Proveedores de servicios

Los proveedores de servicios forman la columna vertebral del framework. Dawn incluye varios proveedores de servicios (enrutamiento, base de datos, sesión...), pero también puedes escribir tus propios e integrarlos fácilmente en Dawn.

Cuando la aplicación está siendo preparada, significa que esta registrando y arrancando los proveedores de servicios incluidos en `config.php`.

Los proveedores de servicios requieren un método `register` y un método `boot`.

En el método `register`, los servicios son enlazados al contenedor de la aplicación. Es llamado una vez por cada proveedor de servicios.

El método `boot` es llamado despues de que todos los servicios hayan sido registrados. Aquí, cada proveedor de serviciós hace las tareas necesarias para preparar los servicios.


# Trabajando con Dawn

* [Enrutamiento](#enrutamiento)
* [Petición](#peticion)
* [Respuesta](#respuesta)
* [Base de datos](#base-de-datos)

## Enrutamiento

* [Añadiendo rutas](#añadiendo-rutas)
* [Protegiendo rutas](#protegiendo-rutas)

El enrutamiento es manejado por el servicio de enrutamiento de Dawn. Incluye un router para encargarse de la petición y la respuesta, rutas personalizadas y un controlador base. 


### Añadiendo rutas

Las rutas son establecidas en `app/routes/web.php` y `app/routes/api.php`.

Para añadir una ruta, simplemente llama el método `get`, `post`, `patch`, `put` o `delete` de la clase `Dawn\Routing\Router`.

Estos métodos esperan los siguientes parámetros:


Parámetro        |                            | Ejemplo
---------------- | -------------------------- | ------------
**`uri`**        | La URI requerida por el usuario. | *La ruta de login es `www.example.com/login`. Por lo tanto, la URI es `login`.*
**`controller`** | El nombre del controlador que se encargará de la petición. Un controlador de Dawn válido pertenece al namespace `App\Controller`. El nombre del controlador debe ser el resto del namespace.                        | *El nombre completo de `LoginController` es `App\Controllers\Auth\LoginController`. Por lo tanto, el nombre del controlador debe ser `Auth\LoginController`.*
**`action`**     | El nombre del método del controlador que se encargará de la petición.                           | *El método `LoginController->showLoginForm()` es el encargado de mostrar una vista de formulario de login. Por lo tanto, la acción es `showLoginForm`.*


```php
$this->get('login', 'Auth\LoginController', 'showLoginForm');
```

### Protegiendo rutas

Las rutas pueden ser protegidas gracias al servicio de autenticación de Dawn. Esto restringirá el acceso a usuarios que no tienen los permisos necesarios.

Por defecto, las rutas están disponibles para todos los usuarios. Dawn ofrece la posibilidad de restringir el acceso a solo invitados (`guest`), solo usuarios autenticados (`auth`) y solo propietarios del recurso (`owner`).

Para proteger una ruta determinada, simplemente llama al método `auth` sobre ella con el parámetro de restricción.

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

Dawn includes a Response class (`Dawn\Routing\Response`) that allows to send responses with headers, cookies and other data attached.

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


## Database

* [Configuration](#configuration)
* [Query builder](#query-builder)

Dawn's database service works with MySQL and PDO. It offers a query builder (`Dawn\Database\QueryBuilder`) and a base model class (`Dawn\Database\Model`) to make querying the database and fetching results easier.

### Configuration

Database credentials should be kept private and safe, therefore they are set in the `.env` file. Remember to not commit this file!

```ini
DB_NAME="dawn"
DB_USER="root"
DB_PASSWORD=""
DB_CONNECTION="localhost"
```

### Query builder

* [Executing raw queries](#executing-raw-queries)
* [Fetching results](#fetching-results)
* [Building queries](#building-queries)
* [Executing built queries](#executing-built-queries)
* [Clearing the query](#clearing-the-query)
* [Getting the last inserted ID](#getting-the-last-inserted-id)

Dawn's query builder is included in Dawn's model, but it also works as a service, so it's accessible from the application container with its `get` method.

```php
$queryBuilder = app()->get('query builder');
```

#### Executing raw queries

Executing raw queries is possible thanks to the `exec` method. It returns the instance of the query builder, so it is possible to chain the `fetch` method to fetch the results.

```php
$users = $queryBuilder->exec('SELECT * FROM users')->fetch('array');
```

#### Fetching results

The query builder's `fetch` method returns the results as objects of a class (`class`) (specified with the `setModel` method), as an array (`array`) or only a column (`column`) (if querying only a column of the table).

```php
// Fetching users as objects of the user model

$queryBuilder->setModel('App\Models\User');

$users = $queryBuilder->exec('SELECT * FROM users')->fetch(); // or fetch('class');
```

```php
// Fetching users as an array

$users = $queryBuilder->exec('SELECT * FROM users')->fetch('array');
```

```php
// Fetching emails only

$emails = $queryBuilder->exec('SELECT email FROM users')->fetch('column');
```

#### Building queries

Queries can be built using methods instead of raw SQL.

The following methods can be used:

**`select`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`columns`**              | Array of columns to select. If it is left empty, it selects all the columns. | *To select the `email` and `password` columns the parameter value is `['email', 'password']`.*

**`from`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`tables`**              | Array of tables to select from. If it is left empty, it selects all the tables. | *To select from the `users` table the parameter value is `['users']`.*

**`where`, `and` and `or`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`column`**              | The column to filter. | *Filter `email` column.*
**`operator`**              | Comparison operator. (=, !=, <, <=, >, >=, between, not between, in, not in, is, like, not like). | *To filter where the value is equal to something, the parameters value is `=`.*
**`value`**              | The value to filter. | *Filter `example@email.com`.*

**`insert`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`table`**              | The table to insert values in. | *Insert in `users` table.*
**`data`**              | Array of data to insert, where the key is the column and the value is the value to insert. | *To insert the user `example`, with email `example@email.com` and password `123456`, the `data` parameter is `['username' => 'example', 'email' => 'example@email.com', 'password' => '123456']`.*

**`update`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`table`**              | The table to update values on. | *Update the `users` table.*
**`data`**              | Array of data to update, where the key is the column and the value is the value to update. | *To update the email to `updated@email.com` and password to `654321`, the `data` parameter is `['email' => 'update@email.com', 'password' => '654321']`.*

**`delete`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`table`**              | The table to delete rows from. | *Delete rows from the `users` table.*

**`orderBy`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`data`**              | Array of data to order by, where the key is the column and the value is the order (`asc` or `desc`). | *To order by `username` and `email` `desc`, the `data` parameter is `['username' => 'desc', 'email' => 'desc']`.*

**`groupBy`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`columns`**              | Array of columns to order by. | *To group by `status`, the parameter is `['status']`.*


#### Executing built queries

Queries are stored in the query builder instance. To check it, the `getQuery` method can be called.

The `exec` method is used without parameters to execute the current query. To fetch the results the `fetch` method can be chained to it.

```php
$queryBuilder->select(['username', 'email'])
  ->from(['users'])
  ->where('status', '=', 'online');

$users = $queryBuilder->exec()->fetch('array');
```

There is also the `get` shortcut method, which executes the query and fetches the result. It expects the same paremeters as the `fetch` method (`class` by default).

```php
$users = $queryBuilder->get('array');
```


#### Clearing the query

The `clear` method allows to clear the query and the prepared statement in case it is needed.

There are also a `clearQuery` and `clearPreparedStatement` methods to clear them separately.

```php
$queryBuilder->clear();
```


#### Getting the last inserted ID

The last inserted ID can be obtained with the `getLastInsertId` method.

```php
$data = [
  'username' => 'example',
  'email' => 'example@email.com',
  'password' => '123456'
];

$queryBuilder->insert('users', $data)->exec();

$lastId = $queryBuilder->getLastInsertId();
```

## Authentication

* [Logging users in](#logging-users-in)
* [Logging users out](#logging-users-out)
* [Registering users](#registering-users)
* [Checking authentication](#checking-authentication)

Authentication is handled by Dawn's Auth service. It is in charge of login, registering users and verifying that the user has the required permissions. It interacts with the database and session services.

This service is implemented in `Dawn\Auth\Auth`.

### Logging users in

The `login` method of the `Dawn\Auth\Auth` class logs users in. It verifies that the credentials are valid and authenticates the user, generating a JWT token and delivering it to the session service.

It expects the following parameters:

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`email`**              | The user's email. | *The user's email is `example@email.com`.*
**`password`**              | The user's password. | *The user's password is `123456`.*

```php
class LoginController extends AuthController
{
  public function login()
  {
      $email = $this->input('email');
      $password = $this->input('password');

      $this->auth->login($email, $password);

      return redirect();
  }
}
```

It is also possible to authenticate a user with the `authenticate` method.

It expects the following parameters:

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`token`**              | A valid JWT token. | *The token is `xxxxxxxxxxxxxxxxxxxxxxxxxxx`.*
**`expires`**              | The expiry time in seconds | *The expiry time is `3600` seconds.*

```php
class LoginController extends AuthController
{
  public function authenticate()
  {
      $token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
      $expires = 3600;

      $this->auth->authenticate($token, $expires);

      return redirect();
  }
}
``` 

### Logging users out

The method `logout` of the `Dawn\Auth\Auth` class logs users out, destroying their session.

```php
class LoginController extends AuthController
{
  public function logout()
  {
      $this->auth->logout();

      return redirect();
  }
}
```

### Registering users

The `register` method of the `Dawn\Auth\Auth` class registers users. It verifies that it is possible to register a user with the user's credentials, registers and authenticates the user.

It expects the following parameters:

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`email`**              | The user's email. | *The user's email is `example@email.com`.*
**`password`**              | The user's password. | *The user's password is `123456`.*

```php
class RegisterController extends AuthController
{
  public function login()
  {
      $email = $this->input('email');
      $password = $this->input('password');

      $this->auth->register($email, $password);

      return redirect();
  }
}
```

### Checking authentication

Dawn allows to check if the current user is authenticated, is a guest or is the owner of a resource.

**`authenticated`**

```php
class LoginController extends AuthController
{
  public function login()
  {
      $email = $this->input('email');
      $password = $this->input('password');

      $this->auth->login($email, $password);

      if ($this->auth->authenticated) {
        return 'You are logged in!';
      }

      return 'There was a problem with the login.';
  }
}
```

**`guest`**

```php
class LoginController extends AuthController
{
  public function showLoginForm()
  {
    if ($this->auth->guest()) {
      return view('auth/login');
    }
    
    return 'You are already authenticated';
  }
}
```

**`isOwner`**

Parameter                  |                               | Example
-------------------------- | ----------------------------- | ------------
**`element`**              | The element to check. | *The element is a `post`.*

```php
class PostController extends AuthController
{
  public function showPost()
  {
    $postModel = new Post();

    $post = $post->queryBuilder
      ->select()
      ->from(['posts'])
      ->where('id', '=', 1)
      ->get();

    if ($this->auth->isOwner($post)) {
      return $this->response($post)->json()->send();
    }

    return 'This is not your post.';
  }
}
```

## Session


# License
Dawn is under [MIT License](https://github.com/diegocasillasdev/dawn/blob/master/LICENSE).
