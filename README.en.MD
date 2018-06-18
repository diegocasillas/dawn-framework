**WORK IN PROGRESS. NOT PRODUCTION READY. BUILT FOR EDUCATIONAL PURPOSES.**

<p align="center">
  <img width="150" src="https://i.imgur.com/S7kzAwk.png">
  <h1 align="center">Dawn</h1>
</p>

* [Introduction](#introduction)
  * [Requirements](#requirements)
  * [Installation](#installation)
* [Directory structure](#directory-structure)
* [Architecture](#architecture)
  * [Request lifecycle](#request-lifecycle)
  * [Application container](#application-container)
  * [Service providers](#service-providers)
* [Working with Dawn](#working-with-dawn)
  * [Application container](#application-container)
  * [Service Providers](#service-providers)
  * [Models](#models)
  * [Controllers](#controllers)
  * [Views](#views)
  * [Routing](#routing)
  * [Request](#request)
  * [Response](#response)
  * [Database](#database)
  * [Authentication](#authentication)
  * [Session](#session)
* [License](#license)

<hr>


# Introduction

Dawn is a light PHP MVC framework for writing web applications and API's in a simple way. It includes routing, database, authentication and session services.
It follows a structure based on the Model-View-Controller pattern and it allows to write scalable and mantainable applications.


## Requirements

Dawn has the following requirements:

* PHP 7.2.4 or newer
  * PDO extension
* MySQL 5.7 or newer
* Composer 1.6.5 or newer
* Apache 2.4 or newer

Note that it might work in older versions, but it has not been tested.

## Installation

`git clone https://github.com/diegocasillasdev/dawn.git`.

`cd dawn && composer install`

`cp example.env .env`

Edit the `.env` file with your settings:

```ini
APP_NAME="Dawn"
KEY="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
DB_NAME="dawn"
DB_USER="root"
DB_PASSWORD=""
DB_CONNECTION="localhost"
```

The key is used to encrypt passwords and generate the authentication token. It should be a random 32 characters long string. This step is very important to keep data secure.

Dawn will try to create a `users` table for you. In case it fails, you can use the following code to create it manually:

```sql
CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(50) NOT NULL,
	`username` VARCHAR(50) NOT NULL,
	`password` VARCHAR(60) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id` (`id`),
	UNIQUE INDEX `email` (`email`),
	UNIQUE INDEX `username` (`username`)
)
```

The code above is just an example. You can create the table as you wish. However, Dawn expects those columns (`id`, `email` and `password`).

**It is required to configure the Apache server to serve the application from the domain's root, for instance cofiguring a *virtual host*.**


# Directory structure

* `[app]`
  * `[controllers]`
  * `[models]`
  * `[routes]`
    * `web.php`
    * `api.php`
  * `[views]`
* `[Dawn]`
* `[docs]`
* `[tests]`
* `[vendor]`
* `.env`
* `.gitignore`
* `.htaccess`
* `composer.json`
* `composer.lock`
* `config.php`
* `example.env`
* `index.php`


## `app`

Contains the application. This is the only folder you have to worry about.

Directory        |                            |
---------------- | -------------------------- |
**`app/controllers`** | Contiene propios controladores de la aplicación. Deberían pertenecer al namespace `App\Controllers` y heredar de `App\Controllers\Controller`.
**`app/models`**        | Contiene tu propios modelos de acceso de datos. Deberían pertenecer al namespace `App\Models` y heredar de `App\Models\Model`.
**`app/routes`**        | Contiene tus rutas de la aplicación definidas.
**`app/routes/web.php`**        | Contiene tus rutas para el punto de entrada web.
**`app/routes/api.php`**        | Contiene tus rutas para el punto de entrada API.
**`app/routes/views`**        | Contiene los archivos de las vistas de tu aplicación.

## Otros directorios

Directorio        |                            |
---------------- | -------------------------- |
**`Dawn`** | Carpeta de Dawn Framework. Contiene todas las clases, servicios y herramientas necesarias para que el framework funcione. No necesitas preocuparte por esta carpeta.
**`docs`** | Contiene los archivos del website de documentación.
**`tests`** | Deberías escribir tus tests aquí.
**`vendor`** | Carpeta de dependencias de Composer.
**`.env`** | Archivo de entorno para datos sensibles. No existe por defecto, necesitas copiarlo de `example.env`. **NO HAGAS COMMIT DE ESTE ARCHIVO.**
**`.gitignore`** | Aquí puedes escribir la ruta de los archivos que no quieres incluir en tu repositorio.
**`.htaccess`** | Archivo de configuración de Apache..
**`composer.json` y `composer.lock`** | Archivos del administrador de paquetes Composer.
**`config.php`** | Contiene los ajustes de tu aplicacion, tales como la sesión, base de datos o proveedores de servicios.
**`example.env`** | Ejemplo para el archivo `.env`.
**`index.php`** | Punto de entrada para la aplicación. Tampoco necesitas preocuparte por este archivo.


# Arquitectura

* [Ciclo de vida de la petición](#ciclo-de-vida-de-la-petición)
* [Contenedor de la aplicación](#contenedor-de-la-aplicación)
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

* [Contenedor de la aplicación](#contenedor-de-la-aplicación)
* [Proveedores de servicios](#proveedores-de-servicios)
* [Modelos](#modelos)
* [Controladores](#controladores)
* [Vistas](#vistas)
* [Enrutamiento](#enrutamiento)
* [Petición](#petición)
* [Respuesta](#respuesta)
* [Base de datos](#base-de-datos)
* [Sesión](#sesión)

## Contenedor de la aplicación

* [Enlazando servicios](enlazando-servicios)
* [Accediendo a servicios](accediendo-a-servicios)

El contenedor de la aplicación de Dawn es la base del framework. En él se contiene la aplicación, los servicios y se prepara y ejecuta la aplicación. Se puede acceder a él con la función `app`. También es una propiedad de los controladores.

```php
$app = app();
```

### Enlazando servicios

Para enlazar servicios al contenedor existe el método `bind`.

Espera los siguientes parámetros:

Parámetro        |                            | Ejemplo
---------------- | -------------------------- | ------------
**`serviceName`**        | El nombre del servicio. | *El servicio se llama `router`.*
**`service`** | The service instance.                       | *La instancia del servicio es `$router`.*


```php
$app()->bind('router', $router);
```

### Accediendo a servicios

Para acceder a los servicios enlazados al contenedor existe el método `get`. Espera como parámetro el nombre del servicio.

```php
$router = $app()->get('router');
```


## Proveedores de servicios

* [Creando proveedores de servicios](#creando-proveedores-de-servicios)
* [Añadiendo proveedores de servicios](#añadiendo-proveedores-de-servicios)

Los proveedores de servicios preparan y enlazan los servicios al contenedor de la aplicación. Los servicios contienen la logica de la aplicación externa a Dawn, asi se pueden añadir por ejemplo servicios de facturación, autorización, email...

### Creando proveedores de servicios

Para crear un proveedor de servicio es necesario extender la clase `Dawn\App\ServiceProvider`.

Los proveedores de servicio deben incluir los métodos `register` y `boot`.

El método `register` debe encargarse únicamente de instanciar los servicios y enlazarlos al contenedor de la aplicación.

El método `boot` se ejecuta una vez que todos los servicios han sido registrados, lo que significa que en el ya se puede acceder a los servicios del controlador, y puede contener toda la lógica necesaria para que los servicios puedan funcionar.

En el siguiente ejemplo, se crea el proveedor de servicio ficticio `HelloWorldServiceProvider`.

En su método `register` se instancia la clase `HelloWorld` y se enlaza al contenedor de la apliacación como `hello world`.

En su método `boot` se recoge el servicio del contenedor de la aplicación con `$this->app->get('hello world')` y también se recoge el servicio ficticio `time`.

```php
namespace App\HelloWorldServiceProvider;

class HelloWorldServiceProvider extends Dawn\App\ServiceProvider
{
  public function register()
  {
    $helloWorld = new HelloWorld():

    $this->app->bind('hello world', $helloWorld);
  }

  public function boot()
  {
    $helloWorld = $this->app->get('hello world');
    $time = $this->app->get('time');

    die("{$helloWorld->sayHi()} it is {$time->now()}");
  }
}
```

### Añadiendo proveedores de servicios

Los proveedores de servicios se añaden en el apartado `service providers` del archivo `config.php`.

```php
'service providers' => [
  'database' => '\\Dawn\\Database\\DatabaseServiceProvider',
  'router' => '\\Dawn\\Routing\\RoutingServiceProvider',
  'session' => '\\Dawn\\Session\\SessionServiceProvider',
  'auth' => '\\Dawn\\Auth\\AuthServiceProvider'
]
```

Para añadir un proveedor de servicio simplemente incluye su nombre y el namespace completo de su clase.

```php
'service providers' => [
  'database' => '\\Dawn\\Database\\DatabaseServiceProvider',
  'router' => '\\Dawn\\Routing\\RoutingServiceProvider',
  'session' => '\\Dawn\\Session\\SessionServiceProvider',
  'hello world' => '\\App\\HelloWorldServiceProvider'
]
```


## Modelos

* [Recomendaciones](#recomendaciones)
* [Creando modelos](#creando-modelos)
* [Modificando propiedades predeterminadas](#modificando-propiedades-predeterminadas)
* [Ocultando propiedades en respuestas JSON](#ocultando-propiedades-en-respuestas-json)
* [Recogiendo registros de la base de datos](#recogiendo-registros-de-la-base-de-datos)

Los modelos son las clases encargadas de interactuar con la base de datos. Para ello, tienen acceso al constructor de consultas además de una serie de métodos predefinidos que facilitan algunas de las consultas más habituales.

### Recomendaciones

Para que Dawn funcione sin necesidad de hacer ajustes, es aconsejable que se sigan las siguientes recomendaciones:

 * La tabla de la base de datos debería tener el nombre del modelo en plural. Por ejemplo, para crear una tabla que contenga los datos de unos mensajes, el nombre de la tabla debería ser `messages`.
 
 * La clase del modelo debería tener un nombre en singular. Por ejemplo, para la tabla `messages`, el nombre de la clase debería ser `message`.

 * La clave primaria debería ser la columna `id`.

 * El nombre de las propiedades debería ser identico a columna de referencia en la tabla. Por ejemplo, si la clave primaria es la columna `post_id`, el nombre de la propiedad de la clase también debería ser `post_id`.


### Creando modelos

Los modelos de la aplicación deberían ser creados en el directorio `app/models`, pertenecer al namespace `App\Models` y extender de la clase `App\Models\Model`.

```php
namespace App\Models;

class Post extends Model
{ 
  protected $title;
  protected $body;

  public function __construct()
  {
    parent::__construct();
  }
}
``` 

### Modificando propiedades predeterminadas

Los modelos heredan las siguientes propiedades del modelo base de Dawn:

Propiedad        |                            |
---------------- | -------------------------- | 
**`queryBuilder`**        | Instancia del constructor de consultas.
**`table`** | El nombre de la tabla de la base de datos a la que pertenece el modelo. Por defecto es el nombre del modelo seguido de la letra 's'.
**`primaryKey`**     | El nombre de la columna que actúa como clave primaria en la base de datos. Por defecto es `id`.
**`id`**     | La columna `id` de la tabla.
**`owner`**     | El `id` del propietario del registro, en caso de que tenga uno.
**`visible`**     | Array de propiedades a mostrar en una respuesta JSON.
**`hidden`**     | Array de propiedades a ocultar en una respuesta JSON.

En caso de que el nombre de la tabla o la clave primaria sean diferentes a los definidos por defecto, es necesario sobreescribir sus propiedades en el constructor.

```php
class Post extends Model
{
  protected $post_id;
  protected $title;
  protected $body;

  public function __construct()
  {
    parent::__construct();
    $this->table = 'my_posts';
    $this->primaryKey = 'post_id';
  }
}
```

Ten en cuenta que al haber modificado la clave primaria, ha sido necesario añadir la propiedad `post_id` a la clase.

### Ocultando propiedades en respuestas JSON

Es posible ocultar datos sensibles o innecesarios en las respuestas enviadas en formato JSON, tales como contraseñas o emails.

Para ello, utiliza el método `hidden` en el constructor del modelo. Este método espera como parámetro un array de los nombres de las propiedades que se quieren ocultar.

```php
class Post extends Model
{
  protected $post_id;
  protected $title;
  protected $body;

  public function __construct()
  {
    parent::__construct();
    $this->table = 'my_posts';
    $this->primaryKey = 'post_id';
    $this->hidden(['post_id']),
  }
}
```

También es posible que en algún momento sea necesario mostrar datos que habían sido ocultados, por ejemplo al hacer que una clase herede de otra.

Para ello, utiliza el método `visible` de la misma forma.

```php
class Comment extends Post
{
  public function __construct()
  {
    parent::__construct();
    $this->visible['post_id'];
  }
}
```

Con esto se consigue que al enviar una respuesta con un objeto de la clase `Post`, la propiedad `post_id` sea ocultada. Sin embargo, al enviar una respuesta con un objeto de la clase `Comment`, la propiedad `post_id` se hace visible de nuevo.

### Recogiendo registros de la base de datos

Los modelos de Dawn, además de incluir el constructor de consultas como propiedad, tienen métodos para hacer algunas de las consultas más comunes.

**`all`** - *Devuelve un array de instancias del modelo por cada registro de la tabla (`SELECT * FROM table`)*

```php
$postModel = new Post();

$posts = $postModel->all();
```

**`find`** - *Devuelve una instancia de un registro de la tabla (`SELECT * FROM table WHERE id=x`)*

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`primaryKey`**              | ID del registro. | *Obtener el registro con ID igual a `5`.*

```php
$postModel = new Post();

$posts = $postModel->find(5);
```

**`getBy`** - *Devuelve un array de instancias del modelo bajo un filtro*

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`key`**              | Nombre de la columna a filtrar. | *Obtener donde la columna `title` sea igual a algo*
**`value`**              | Valor del filtro. | *Obtener donde el valor del registro en esa columna sea `Hello World`.*

```php
$postModel = new Post();

$posts = $postModel->getBy('title', 'Hello World');
```

**`getColumnBy`** - *Devuelve un único campo de la tabla del modelo bajo un filtro por columna.*

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`column`**              | Nombre de la columna de la que obtener el valor. | *Obtener un valor de la columna `body`.*
**`key`**              | Nombre de la columna a filtrar. | *Obtener donde la columna `title` sea igual a algo*
**`value`**              | Valor del filtro. | *Obtener donde el valor del registro en esa columna sea `Hello World`.*

```php
$postModel = new Post();

$body = $postModel->getColumnBy('body', 'title', 'Hello World');
```

## Controladores

* [Creando controladores](#creando-controladores)
* [Accediendo a los servicios](#accediendo-a-los-servicios)

Los controladores son los encargados de utilizar los servicios y modelos necesarios para cumplir con la demanda de la petición, además de enviar una respuesta o mostrar una vista.

### Creando controladores

Los controladores de la aplicación deberían ser creados en el directorio `app/controllers`, pertenecer al namespace `App\Controllers` y extender de la clase `App\Controllers\Controllers`.

```php
namespace App\Controllers;

class PostController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }
}
```

### Accediendo a los servicios

Los servicios del contenedor de la aplicación pueden ser accedidos desde el método `get` de la aplicación.

```php
class PostController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $helloWorld = $this->app->get('hello world');

    return $helloWorld->sayHi();
  }
}
```

## Vistas

* [Creando vistas](#creando-vistas)
* [Mostrando vistas](#mostrando-vistas)
* [Accediendo a los datos de la vista](#accediendo-a-los-datos-de-la-vista)
* [Añadiendo enlaces a archivos](#añadiendo-enlaces-a-archivos)

Las vistas de Dawn son plantillas HTML que muestran los datos obtenidos del controlador.

### Creando vistas

Las vistas de la aplicación deberían ser creadas en el directorio `app/views` con un nombre de archivo acabado en `.view.php`.

### Mostrando vistas

Para mostrar vistas desde un controlador, se puede utilizar la función `view`.

Espera los siguientes parámetros:

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`name`**              | Nombre de la vista (excluyendo `.view.php`). | *Para mostrar la vista localizada en `app/views/index.view.php`, el parámetro name es `index`.*
**`data`**              | Array de datos a pasar a la vista, donde la key es el nombre de la variable por la que se quiere acceder, y el valor es el valor del dato. | *Para pasar la variable `$post`, el valor del parámetro es `['post' => $post]`.*

```php
class PostController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $postModel = new Post();

    $post = $postModel->find(1);

    return view('index', ['post' => $post]);
  }
}
```

Es posible utilizar la función `compact` para hacer el paso de datos más sencillo:

```php
public function index()
{
  $postModel = new Post();

  $post = $postModel->find(1);

  return view('index', compact('post'));
}
```

Las vistas pueden estar contenidas en directorios, por ejemplo podemos encontrar la vista `app/views/post/index.view.php`. En este caso, el valor del parámetro `name` sería `post/index`.

```php
view('post/index', compact('post'));
```

### Accediendo a los datos de la vista

Los datos de la vista son accesibles desde la variable con el nombre correspondiente al pasado por el método `view`.

```php
view('post/index', compact('post'));
```

En este caso, en la vista existirá la variable `$post`:

```html
<div>
  <h1><?php echo $post->getTitle() ?></h1>
  <p><?php echo $post->getBody() ?></p>
</div>
```

### Añadiendo enlaces a archivos

Para añadir enlaces a archivos tales como hojas de estilo, scripts o imágenes, siempre es necesario especificar la ruta completa desde la raíz de Dawn.

Por ejemplo, para una hoja de estilo localizada en `app/views/assets/style.css`:

```html
<link rel="stylesheet" href="/app/views/assets/style.css">
```


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


## Petición

* [Accediendo al input de la petición](#accediendo-al-input-de-la-petición)
* [Comprobando si el valor de un input está vacío](#comprobando-si-el-valor-de-un-input-esta-vacío)
* [Obteniendo la dirección IP y el User Agent de la petición](#obteniendo-la-dirección-ip-y-el-user-agent-de-la-petición)

La petición actual es accesible desde el router y desde el controlador que la maneja.

### Accediendo al input de la petición

El input de la petición puede ser accedido con el método `input` del controlador:

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

Un valor de un único input también puede ser accedido pasando su key como parámetro al método `input`.

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

### Comprobando si el valor de un input está vacío

Se puede comprobar si el valor de un input está vacío con el método `empty`:

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


### Obteniendo la dirección IP y el User Agent de la petición

La dirección y el User Agent de la petición puede ser accedido desde los métodos `ip` y `userAgent`.

```php
class LoginController extends AuthController
{
  public function requestInfo()
  {
    $ip = $this->ip();
    $userAgent = $this->userAgent();

    return "IP Address: {$ip} - User Agent: {$userAgent}";
  }
}
```

## Respuesta

* [Enviando una respuesta simple](#enviando-una-respuesta-simple)
* [Enviando una respuesta completa](#enviando-una-respuesta-completa)

### Enviando una respuesta simple

Para enviar una respuesta simple, simplemente devuelve un valor o una vista.

```php
class LoginController extends AuthController
{
  public function showLoginForm()
  {
    return view('auth/login');
  }
}
```

### Enviando una respuesta completa

* [Estableciendo un código de estado](#estableciendo-un-código-de-estado)
* [Añadiendo cabeceras](#añadiendo-cabeceras)
* [Añadiendo una cabecera de token de autenticación](#añadiendo-una-cabecera-de-token-de-autenticación)
* [Añadiendo datos](#añadiendo-datos)
* [Respuesta JSON](#respuesta-json)
* [Usando el método response del controlador](#usando-el-método-response-del-controlador)

Dawn incluye una clase Response (`Dawn\Routing\Response`) que permite enviar respuestas con cabeceras, cookies y otros datos adjuntos.

Esto puede hacerse con la propiedad `response` del controlador y el método `response`. Diferentes métodos pueden ser encadenados y una vez que la respuesta está lista puede ser enviada con su método `send`.

#### Estableciendo un código de estado

Establecer un código de estado puede ser fácilmente conseguido con el método `status` de la respuesta.

Este método espera los siguientes parámetros.

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`code`**                 | Código de estado (número entero). | *El recurso no ha sido encontrado, por lo tanto, el código de estado más adecuado es `404`.*
**`message`** *[opcional]* | Mensaje de estado personalizado. Si un mensaje de estado no es pasado al método, Dawn intentará encontrar el mensaje correspondiente al código de estado.                                                               | *El código de estado es `404`, asi que el mensaje de estádo será `Not Found` a no ser que sea sobreescrito.*


```php
class LoginController extends AuthController
{
  public function notFound()
  {
    return $this->response->status('404')->send();
  }
}
```


#### Añadiendo cabeceras

Se pueden añadir cabeceras con el método `header` de la respuesta.

Espera los siguientes parámetros:

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`name`**                 | El nombre de la cabecera. | *Para enviar una cookie con la respuesta, es necesaria la cabecera `Set-Cookie`. Por lo tanto, el nombre de la cabecera es `Set-Cookie`.*
**`value`** | El valor de la cabecera.                                                               | *El nombre de la cookie es `color` y su valor es `red`. Por lo tanto, el valor de la cabecera es `color=red`.*

```php
class LoginController extends AuthController
{
  public function addColor()
  {
    return $this->response->header('Set-Cookie', 'color=red')->send();
  }
}
```


#### Añadiendo una cabecera de token de autenticación

Las cabeceras de token pueden ser añadidas con el método `token` de la respuesta.

```php
class LoginController extends AuthController
{
  public function addToken()
  {
    return $this->response->token('xxxxxxxxxxxxxxxxxx')->send();
  }
}
```

#### Añadiendo datos

Los datos pueden ser añadidos a la respuesta con su método `data`.

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

#### Respuesta JSON

Las respuestas JSON pueden ser enviadas con el método `json` de la respuesta.

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

#### Usando el método response del controlador

Las respuestas también pueden ser enviadas utilizando el método `response` del controlador.

Espera los siguientes parámetros:

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`data`**                 | Los datos para ser enviados con la respuesta. | *Los datos están contenidos en el array `$data`. Por lo tanto, el parámetro es `$data`.*
**`statusCode`** *[opcional]* | El código de estado de la respuesta. Si no es pasado al método, será `200`.                                                               | *El código de estado es `200`. Por lo tanto, no es necesario pasarlo al método.*


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


## Base de datos

* [Configuración](#configuración)
* [Constructor de consultas](#constructor-de-consultas)

El servicio de base de datos de Dawn funciona con MySQL y PDO. Ofrece un constructor de consultas (`Dawn\Database\QueryBuilder`) y una clase modelo base (`Dawn\Database\Model`) para hacer consultas a la base de datos y recoger resultados más fácil.

### Configuración

Las credenciales deberían mantenerse privadas y seguras, por lo tanto son establecidas en el archivo `.env`. ¡Recuerda no hacer commit de este archivo!

```ini
DB_NAME="dawn"
DB_USER="root"
DB_PASSWORD=""
DB_CONNECTION="localhost"
```

### Constructor de consultas

* [Ejecutando consultas puras](#ejecutando-consultas-puras)
* [Recogiendo resultados](#recogiendo-resultados)
* [Construyendo consultas](#construyendo-consultas)
* [Ejecutando consultas construidas](#ejecutando-consultas-construidas)
* [Limpiando la consulta](#limpiando-la-consulta)
* [Obteniendo el último ID insertado](#obteniendo-el-último-id-insertado)

El constructor de consultas de Dawn está incluido en el modelo de Dawn, pero también funciona como un servicio, por lo que es accesible desde el contenedor de la aplicación con su método `get`.

```php
$queryBuilder = app()->get('query builder');
```

#### Ejecutando consultas puras

Ejecutar consultas puras es posible gracias al método `exec`. Devuelve la instancia del constructor de consultas, por lo que es posible encadenar el método `fetch` para recoger los resultados.

```php
$users = $queryBuilder->exec('SELECT * FROM users')->fetch('array');
```

#### Recogiendo resultados

El método `fetch` del constructor de consultas devuelve los resultados como objetos de una clase (`class`) (definida con el método `setModel`), como un array (`array`) o como una columna única (`column`) (si se consulta solo una columna de la tabla).

```php
// Recogiendo usuarios como objetos del modelo usuario

$queryBuilder->setModel('App\Models\User');

$users = $queryBuilder->exec('SELECT * FROM users')->fetch(); // o fetch('class');
```

```php
// Recogiendo usuarios como array

$users = $queryBuilder->exec('SELECT * FROM users')->fetch('array');
```

```php
// Recogiendo solo los emails

$emails = $queryBuilder->exec('SELECT email FROM users')->fetch('column');
```

#### Construyendo consultas

Las consultas pueden ser construidas usando métodos en vez de SQL puro.

Los siguientes métodos pueden ser utilizados:

**`select`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`columns`**              | Array de columnas a seleccionar. Si se deja vacío, selecciona todas las columnas. | *Para seleccionar las columnas `email` y `password` el valor del parámetro es `['email', 'password']`.*

**`from`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`tables`**              | Array de tablas desde las que hacer la selección. Si se deja vacío, selecciona todas las tablas. | *Para seleccionar de la tabla `users` el valor del parámetro es `['users']`.*

**`where`, `and` y `or`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`column`**              | La columna a filtrar. | *Filtrar la columna `email`.*
**`operator`**              | Operador de comparación. (=, !=, <, <=, >, >=, between, not between, in, not in, is, like, not like). | *Para filtrar donde el valor es igual a algo, el valor del parámetro es `=`.*
**`value`**              | El valor a filtrar. | *Filtrar `example@email.com`.*

**`insert`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`table`**              | La tabla en la que insertar valores. | *Insertar en la tabla `users`.*
**`data`**              | Array de datos a insertar, donde la key es la columna y el valor es el valor a insertar. | *Para insertar el usuario `example`, con email `example@email.com` y contraseña `123456`, el parámetro `data` es `['username' => 'example', 'email' => 'example@email.com', 'password' => '123456']`.*

**`update`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`table`**              | La tabla en la que actualizar valores. | *Actualizar la tabla `users`.*
**`data`**              | Array de datos a actualizar, donde la key es la columna y el valor es el valor a actualizar. | *Para actualizar el email a  `updated@email.com` y la contraseña a `654321`, el parámetro `data` es `['email' => 'update@email.com', 'password' => '654321']`.*

**`delete`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`table`**              | La tabla en la que eliminar filas. | *Eliminar filas de la tabla `users`.*

**`orderBy`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`data`**              | Array de datos por los que ordenar, donde la key es la columna y el valor es el orden (`asc` or `desc`). | *Para ordernar por `username` y `email` `desc`, el parámetro `data` es `['username' => 'desc', 'email' => 'desc']`.*

**`groupBy`**

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`columns`**              | Array de columnas por las que agrupar. | *Para agrupar por `status`, el parámetro es `['status']`.*


#### Ejecutando consultas construidas

Las consulta es guardada en la instancia del constructor de consultas. Para comprobarla, se puede llamar al método `getQuery`.

El método `exec` es utilizado sin parametros para ejecutar la consulta actual. Para recoger los resultados se puede encadenar el método `fetch`.

```php
$queryBuilder->select(['username', 'email'])
  ->from(['users'])
  ->where('status', '=', 'online');

$users = $queryBuilder->exec()->fetch('array');
```


Tambien existe el método atajo `get`, que ejecuta la consulta y recoge el resultado. Espera los mismos parametros que el método `fetch` (`class` por defecto).

```php
$users = $queryBuilder->get('array');
```


#### Limpiando la consulta

El método `clear` permite limpiar la consulta y la sentencia preparada en caso necesario.

También existen los métodos `clearQuery` y `clearPreparedStatement` para limpiarlos por separado.

```php
$queryBuilder->clear();
```


#### Obteniendo el último ID insertado

El último ID insertado puede ser obtenido con el método `getLastInsertId`.

```php
$data = [
  'username' => 'example',
  'email' => 'example@email.com',
  'password' => '123456'
];

$queryBuilder->insert('users', $data)->exec();

$lastId = $queryBuilder->getLastInsertId();
```

## Autenticación

* [Logueando usuarios](#logueando-usuarios)
* [Deslogueando usuarios](#deslogueando-usuarios)
* [Registrando usuarios](#registrando-usuarios)
* [Comprobando la autenticación](#comprobando-la-autenticación)

La autenticación es manejada por el servicio Auth the Dawn. Está encargado del login, registro de usuarios y verificar que el usuario tiene los permisos requeridos. Interactua con los servicios de base de datos y sesión.

Este servicio está implementado en `Dawn\Auth\Auth`.

### Logueando usuarios

El método `login` de la clase `Dawn\Auth\Auth` loguea a los usuarios. Verifica que las credenciales son válidas y autentica al usuario, generando un token JWT y entregándoselo al servicio de sesión.

Espera los siguientes parámetros:

Parametro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`email`**              | El email del usuario. | *El email del usuario es `example@email.com`.*
**`password`**              | La contraseña del usuario. | *La contraseña del usuario es `123456`.*

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

También es posible autenticar a un usuario con el método `authenticate`.

Espera los siguientes parámetros:

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`token`**              | Un token JWT válido. | *El token es `xxxxxxxxxxxxxxxxxxxxxxxxxxx`.*
**`expires`**              | Tiempo de expiración en segundos. | *El tiempo de expiración es `3600` segundos.*

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

### Deslogueando usuarios

El método `logout` de la clase `Dawn\Auth\Auth` desloguea al usuario, destruyendo su sesión.

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

### Registrando usuarios

El método `register` de la clase `Dawn\Auth\Auth` registra usuarios. Verifica que es posible registrar un usuario con sus credenciales, lo registra y autentica.

Espera los siguientes parámetros:

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`email`**              | El email del usuario. | *El email del usuario es `example@email.com`.*
**`password`**              | La contraseña del usuario. | *La contraseña del usuario es `123456`.*

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

### Comprobando la autenticación

Dawn permite comprobar si el usuario actual está autenticado, es un invitado o es el propietario del recurso.

**`authenticated`**

```php
class LoginController extends AuthController
{
  public function login()
  {
      $email = $this->input('email');
      $password = $this->input('password');

      $this->auth->login($email, $password);

      if ($this->auth->authenticated()) {
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

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`element`**              | El elemento a comprobar. | *El elemento es `$post`.*

```php
class PostController extends Controller
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

## Sesión

* [Configurando la sesión](#configurando-la-sesión)
* [Obteniendo el token de la cabecera](#obteniendo-el-token-de-la-cabecera)

La sesión es manejada por el servicio de sesión de Dawn, implementado en `Dawn\Session\Session`.

### Configurando la sesión

La sesión puede configurarse en el apartado `session` del archivo `config.php`.

Dawn ofrece modos de configuración para la sesión, `cookie`, `session` y `local storage`.

El tiempo de expiración se especifica en segundos.

```php
'session' => [
    'mode' => 'cookie',
    'expires' => 864000
]
```

`cookie` envía una cookie al cliente en una cabecera con el token de autenticación.

`session` crea una sesión PHP en el servidor.

`local storage` devuelve una respuesta que incluye el token en formato JSON cuando el usuario se loguea.

### Obteniendo el token de la cabecera

Para obtener el token de la cabecera, se puede utilizar el método `bearer` de la sesión.

```php
class LoginController extends AuthController
{
  public function getToken()
  {
    $session = $this->app->get('session');

    return $session->bearer();
  }
}
```


# Licencia
Dawn está bajo [Licencia MIT](https://github.com/diegocasillasdev/dawn/blob/master/LICENSE).
