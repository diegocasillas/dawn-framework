<p align="center">
  <img width="150" src="https://i.imgur.com/S7kzAwk.png">
  <h1 align="center">Dawn</h1>
</p>

* [Feature list](#feature-list)
* [Upcoming features](#upcoming-features)
* [Guía rápida](#guia-rápida)
* [Estructura de directorios](#estructura-de-directorios)
* [Arquitectura](#arquitectura)
  * [Ciclo de vida de la petición](#ciclo-de-vida-de-la-petición)
  * [Contenedor de la aplicación](#contenedor-de-la-aplicación)
  * [Proveedores de servicios](#proveedores-de-servicios)
* [Trabajando con Dawn](#trabajando-con-Dawn)
  * [Enrutamiento](#enrutamiento)
  * [Petición](#petición)
  * [Respuesta](#respuesta)
  * [Base de Datos](#base-de-datos)
  * [Autenticación](#autenticación)
  * [Sesión](#sesión)
* [Licencia](#licencia)

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

* [Enrutamiento](#enrutamiento)
* [Petición](#petición)
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

    return "IP Address: {$ip] - User Agent: {$userAgent}";
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
* [Construyendo consultas](#construyendo consultas)
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

Parámetro                  |                               | Ejemplo
-------------------------- | ----------------------------- | ------------
**`element`**              | El elemento a comprobar. | *El elemento es `$post`.*

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

## Sesión


# Licencia
Dawn está bajo [Licencia MIT](https://github.com/diegocasillasdev/dawn/blob/master/LICENSE).
