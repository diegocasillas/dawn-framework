<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dawn</title>
  <link rel="stylesheet" href="/app/views/home/assets/readme.css">

  <style>
    .page-header {
      height: 100vh;
    }
    
    .vertical-center {
      top: 50%;
      position: relative;
      transform: translateY(-50%)
    }

    .logo {
      margin: 60px;
    }

    .animated {
      -webkit-animation-duration: 2s;
      animation-duration: 2s;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
    }
    
    .animated.infinite {
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
    }

    @-webkit-keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .fadeIn {
      -webkit-animation-name: fadeIn;
      animation-name: fadeIn;
    }

    @-webkit-keyframes pulse {
      from {
        -webkit-transform: scale3d(0.8, 0.8, 0.8);
        transform: scale3d(0.8, 0.8, 0.8);
      }

      50% {
        -webkit-transform: scale3d(1.05, 1.05, 1.05);
        transform: scale3d(1.05, 1.05, 1.05);
      }

      to {
        -webkit-transform: scale3d(0.8, 0.8, 0.8);
        transform: scale3d(0.8, 0.8, 0.8);
      }
    }

    @keyframes pulse {
      from {
        -webkit-transform: scale3d(0.8, 0.8, 0.8);
        transform: scale3d(0.8, 0.8, 0.8);
      }

      50% {
        -webkit-transform: scale3d(1.05, 1.05, 1.05);
        transform: scale3d(1.05, 1.05, 1.05);
      }

      to {
        -webkit-transform: scale3d(0.8, 0.8, 0.8);
        transform: scale3d(0.8, 0.8, 0.8);
      }
    }

    .pulse {
      -webkit-animation-name: pulse;
      animation-name: pulse;
    }

    .chevron {
      width: 40px;
    }
  </style>
</head>

<body>
  <section class="page-header">
    <div class="vertical-center">
      <div class="animated fadeIn">
        <h1 class="project-name">Dawn</h1>
        <p align="center" class="logo">
          <img width="240" src="/app/views/home/assets/dawn.png" />
        </p>
        <h2 class="project-tagline">Framework PHP MVC para construir web apps y APIs</h2>

        <a href="https://github.com/diegocasillasdev/Dawn" class="btn">Ver en GitHub</a>

        <div class="chevron-container animated infinite pulse">
          <img class="chevron" src="/app/views/home/assets/chevron-bottom.svg" />
        </div>
      </div>
    </div>
  </section>

  <section class="main-content">
    <ul>
      <li>
        <a href="#introducción">Introducción</a>
        <ul>
          <li>
            <a href="#requisitos">Requisitos</a>
          </li>
          <li>
            <a href="#instalación">Instalación</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#estructura-de-directorios">Estructura de directorios</a>
      </li>
      <li>
        <a href="#arquitectura">Arquitectura</a>
        <ul>
          <li>
            <a href="#ciclo-de-vida-de-la-petición">Ciclo de vida de la petición</a>
          </li>
          <li>
            <a href="#contenedor-de-la-aplicación">Contenedor de la aplicación</a>
          </li>
          <li>
            <a href="#proveedores-de-servicios">Proveedores de servicios</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#trabajando-con-dawn">Trabajando con Dawn</a>
        <ul>
          <li>
            <a href="#contenedor-de-la-aplicación">Contenedor de la aplicación</a>
          </li>
          <li>
            <a href="#proveedores-de-servicios">Proveedores de servicios</a>
          </li>
          <li>
            <a href="#modelos">Modelos</a>
          </li>
          <li>
            <a href="#controladores">Controladores</a>
          </li>
          <li>
            <a href="#vistas">Vistas</a>
          </li>
          <li>
            <a href="#enrutamiento">Enrutamiento</a>
          </li>
          <li>
            <a href="#petición">Petición</a>
          </li>
          <li>
            <a href="#respuesta">Respuesta</a>
          </li>
          <li>
            <a href="#base-de-datos">Base de Datos</a>
          </li>
          <li>
            <a href="#autenticación">Autenticación</a>
          </li>
          <li>
            <a href="#sesión">Sesión</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#licencia">Licencia</a>
      </li>
    </ul>

    <hr />

    <h1 id="introducción">Introducción</h1>

    <p>Dawn es un framework PHP MVC ligero para escribir aplicaciones web y APIs de forma sencilla. Incluye servicios de enrutamiento,
      bases de datos, autenticación y sesión totalmente configurados.</p>

    <p>Sigue una estructura basada en el patrón de diseño Modelo-Vista-Controlador y permite escribir aplicaciones escalables
      y mantenibles.</p>

    <h2 id="requisitos">Requisitos</h2>

    <p>Dawn tiene los siguientes requisitos:</p>

    <ul>
      <li>PHP 7.2.4 o superior
        <ul>
          <li>Extensión PDO</li>
        </ul>
      </li>
      <li>MySQL 5.7 o superior</li>
      <li>Composer 1.6.5 o superior</li>
      <li>Apache 2.4 o superior</li>
    </ul>

    <p>Ten en cuenta que podría funcionar bajo versiones anteriores, pero no ha sido testeado.</p>

    <h2 id="instalación">Instalación</h2>

    <p>
      <code class="highlighter-rouge">git clone https://github.com/diegocasillasdev/dawn.git</code> en el directorio deseado.</p>

    <p>
      <code class="highlighter-rouge">cd dawn &amp;&amp; composer install</code>
    </p>

    <p>
      <code class="highlighter-rouge">cp example.env .env</code>
    </p>

    <p>Edita el archivo
      <code class="highlighter-rouge">.env</code> con tus ajustes:</p>

    <div class="language-ini highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="py">APP_NAME</span><span class="p">=</span><span class="s">"Dawn"</span>
<span class="py">KEY</span><span class="p">=</span><span class="s">"XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"</span>
<span class="py">DB_NAME</span><span class="p">=</span><span class="s">"dawn"</span>
<span class="py">DB_USER</span><span class="p">=</span><span class="s">"root"</span>
<span class="py">DB_PASSWORD</span><span class="p">=</span><span class="s">""</span>
<span class="py">DB_CONNECTION</span><span class="p">=</span><span class="s">"localhost"</span>
</code></pre>
      </div>
    </div>

    <p>La key es usada para encriptar contraseñas y generar el token de la sesión. Debería ser una cadena de 32 caracteres aleatorios.
      Este paso es muy importante para mantener los datos seguros.</p>

    <p>Crea una tabla
      <code class="highlighter-rouge">users</code>:</p>

    <div class="language-sql highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="nv">`users`</span> <span class="p">(</span>
	<span class="nv">`id`</span> <span class="n">INT</span><span class="p">(</span><span class="mi">11</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span><span class="p">,</span>
	<span class="nv">`email`</span> <span class="n">VARCHAR</span><span class="p">(</span><span class="mi">50</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span><span class="p">,</span>
	<span class="nv">`username`</span> <span class="n">VARCHAR</span><span class="p">(</span><span class="mi">50</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span><span class="p">,</span>
	<span class="nv">`password`</span> <span class="n">VARCHAR</span><span class="p">(</span><span class="mi">60</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span><span class="p">,</span>
	<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="nv">`id`</span><span class="p">),</span>
	<span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="nv">`id`</span> <span class="p">(</span><span class="nv">`id`</span><span class="p">),</span>
	<span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="nv">`email`</span> <span class="p">(</span><span class="nv">`email`</span><span class="p">),</span>
	<span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="nv">`username`</span> <span class="p">(</span><span class="nv">`username`</span><span class="p">)</span>
<span class="p">)</span>
</code></pre>
      </div>
    </div>

    <p>El código de arriba es solo un ejemplo. Puedes crear la tabla como desees. Sin embargo, Dawn espera que tenga esas columnas
      (
      <code class="highlighter-rouge">id</code>,
      <code class="highlighter-rouge">email</code> and
      <code class="highlighter-rouge">password</code>). Si quieres modificarlas, tendras que editar las clases
      <code class="highlighter-rouge">App\Model\User</code> y
      <code class="highlighter-rouge">Dawn\Auth\Auth</code>.</p>

    <p>
      <strong>Es necesario configurar el servidor Apache para servir la aplicación desde la raíz del dominio, por ejemplo configurando
        un
        <em>virtual host</em>.</strong>
    </p>

    <h1 id="estructura-de-directorios">Estructura de directorios</h1>

    <ul>
      <li>
        <code class="highlighter-rouge">[app]</code>
        <ul>
          <li>
            <code class="highlighter-rouge">[controllers]</code>
          </li>
          <li>
            <code class="highlighter-rouge">[models]</code>
          </li>
          <li>
            <code class="highlighter-rouge">[routes]</code>
            <ul>
              <li>
                <code class="highlighter-rouge">web.php</code>
              </li>
              <li>
                <code class="highlighter-rouge">api.php</code>
              </li>
            </ul>
          </li>
          <li>
            <code class="highlighter-rouge">[views]</code>
          </li>
        </ul>
      </li>
      <li>
        <code class="highlighter-rouge">[Dawn]</code>
      </li>
      <li>
        <code class="highlighter-rouge">[docs]</code>
      </li>
      <li>
        <code class="highlighter-rouge">[tests]</code>
      </li>
      <li>
        <code class="highlighter-rouge">[vendor]</code>
      </li>
      <li>
        <code class="highlighter-rouge">.env</code>
      </li>
      <li>
        <code class="highlighter-rouge">.gitignore</code>
      </li>
      <li>
        <code class="highlighter-rouge">.htaccess</code>
      </li>
      <li>
        <code class="highlighter-rouge">composer.json</code>
      </li>
      <li>
        <code class="highlighter-rouge">composer.lock</code>
      </li>
      <li>
        <code class="highlighter-rouge">config.php</code>
      </li>
      <li>
        <code class="highlighter-rouge">example.env</code>
      </li>
      <li>
        <code class="highlighter-rouge">index.php</code>
      </li>
    </ul>

    <h2 id="app">
      <code class="highlighter-rouge">app</code>
    </h2>

    <p>Contiene tu aplicación. Esta carpeta es la única de la que tienes que preocuparte.</p>

    <table>
      <thead>
        <tr>
          <th>Directorio</th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">app/controllers</code>
            </strong>
          </td>
          <td>Contiene propios controladores de la aplicación. Deberían pertenecer al namespace
            <code class="highlighter-rouge">App\Controllers</code> y heredar de
            <code class="highlighter-rouge">App\Controllers\Controller</code>.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">app/models</code>
            </strong>
          </td>
          <td>Contiene tu propios modelos de acceso de datos. Deberían pertenecer al namespace
            <code class="highlighter-rouge">App\Models</code> y heredar de
            <code class="highlighter-rouge">App\Models\Model</code>.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">app/routes</code>
            </strong>
          </td>
          <td>Contiene tus rutas de la aplicación definidas.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">app/routes/web.php</code>
            </strong>
          </td>
          <td>Contiene tus rutas para el punto de entrada web.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">app/routes/api.php</code>
            </strong>
          </td>
          <td>Contiene tus rutas para el punto de entrada API.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">app/routes/views</code>
            </strong>
          </td>
          <td>Contiene los archivos de las vistas de tu aplicación.</td>
        </tr>
      </tbody>
    </table>

    <h2 id="otros-directorios">Otros directorios</h2>

    <table>
      <thead>
        <tr>
          <th>Directorio</th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">Dawn</code>
            </strong>
          </td>
          <td>Carpeta de Dawn Framework. Contiene todas las clases, servicios y herramientas necesarias para que el framework
            funcione. No necesitas preocuparte por esta carpeta.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">docs</code>
            </strong>
          </td>
          <td>Contiene los archivos del website de documentación.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">tests</code>
            </strong>
          </td>
          <td>Deberías escribir tus tests aquí.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">vendor</code>
            </strong>
          </td>
          <td>Carpeta de dependencias de Composer.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">.env</code>
            </strong>
          </td>
          <td>Archivo de entorno para datos sensibles. No existe por defecto, necesitas copiarlo de
            <code class="highlighter-rouge">example.env</code>.
            <strong>NO HAGAS COMMIT DE ESTE ARCHIVO.</strong>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">.gitignore</code>
            </strong>
          </td>
          <td>Aquí puedes escribir la ruta de los archivos que no quieres incluir en tu repositorio.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">.htaccess</code>
            </strong>
          </td>
          <td>Archivo de configuración de Apache..</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">composer.json</code> y
              <code class="highlighter-rouge">composer.lock</code>
            </strong>
          </td>
          <td>Archivos del administrador de paquetes Composer.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">config.php</code>
            </strong>
          </td>
          <td>Contiene los ajustes de tu aplicacion, tales como la sesión, base de datos o proveedores de servicios.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">example.env</code>
            </strong>
          </td>
          <td>Ejemplo para el archivo
            <code class="highlighter-rouge">.env</code>.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">index.php</code>
            </strong>
          </td>
          <td>Punto de entrada para la aplicación. Tampoco necesitas preocuparte por este archivo.</td>
        </tr>
      </tbody>
    </table>

    <h1 id="arquitectura">Arquitectura</h1>

    <ul>
      <li>
        <a href="#ciclo-de-vida-de-la-petición">Ciclo de vida de la petición</a>
      </li>
      <li>
        <a href="#contenedor-de-la-aplicación">Contenedor de la aplicación</a>
      </li>
      <li>
        <a href="#proveedores-de-servicios">Proveedores de servicios</a>
      </li>
    </ul>

    <h2 id="ciclo-de-vida-de-la-petición">Ciclo de vida de la petición</h2>

    <p>El punto de entrada para todas las peticiones es
      <code class="highlighter-rouge">index.php</code>. Todas las peticiones son dirigidas a este archivo por Apache.</p>

    <p>En
      <code class="highlighter-rouge">index.php</code>, Dawn es preparado. Esto significa que la aplicación es cargada con la configuración y los proveedores de servicios.
      Cuando esta listo, la aplicación es ejecutada.</p>

    <p>Despues, el servicio
      <em>Router</em> se encarga de la petición, procesandola, encontrando que ruta ha sido requerida por el usuario y dirigiendola
      al servicio
      <em>Controller Dispatcher</em>.</p>

    <p>El
      <em>Controller Dispatcher</em> se encarga de crear una nueva instancia del
      <em>Controller</em> que necesita manejar la petición, y prepararlo para llamar la acción requerida.</p>

    <p>Finalmente, el
      <em>Controller</em> delega momentáneamente la petición al
      <em>Middleware</em>, que verificará que todo está en orden (autenticación, autorización…). Despues de ello, el
      <em>Controller</em> hace su trabajo y manda una respuesta de vuelta.</p>

    <h2 id="contenedor-de-la-aplicación">Contenedor de la aplicación</h2>

    <p>El contenedor de la aplicación de Dawn contiene todo lo necesario para que la aplicación funcione. Está implementado
      en
      <code class="highlighter-rouge">Dawn/App/App.php</code>.</p>

    <p>Los servicios son enlazados a él gracias a los
      <em>proveedores de servicios</em>.</p>

    <p>Está en cargo de preparar la aplicación, ejecutarla y proveer sus servicios enlazados.</p>

    <h2 id="proveedores-de-servicios">Proveedores de servicios</h2>

    <p>Los proveedores de servicios forman la columna vertebral del framework. Dawn incluye varios proveedores de servicios
      (enrutamiento, base de datos, sesión…), pero también puedes escribir tus propios e integrarlos fácilmente en Dawn.</p>

    <p>Cuando la aplicación está siendo preparada, significa que esta registrando y arrancando los proveedores de servicios
      incluidos en
      <code class="highlighter-rouge">config.php</code>.</p>

    <p>Los proveedores de servicios requieren un método
      <code class="highlighter-rouge">register</code> y un método
      <code class="highlighter-rouge">boot</code>.</p>

    <p>En el método
      <code class="highlighter-rouge">register</code>, los servicios son enlazados al contenedor de la aplicación. Es llamado una vez por cada proveedor de servicios.</p>

    <p>El método
      <code class="highlighter-rouge">boot</code> es llamado despues de que todos los servicios hayan sido registrados. Aquí, cada proveedor de serviciós hace las tareas
      necesarias para preparar los servicios.</p>

    <h1 id="trabajando-con-dawn">Trabajando con Dawn</h1>

    <ul>
      <li>
        <a href="#contenedor-de-la-aplicación">Contenedor de la aplicación</a>
      </li>
      <li>
        <a href="#proveedores-de-servicios">Proveedores de servicios</a>
      </li>
      <li>
        <a href="#modelos">Modelos</a>
      </li>
      <li>
        <a href="#controladores">Controladores</a>
      </li>
      <li>
        <a href="#vistas">Vistas</a>
      </li>
      <li>
        <a href="#enrutamiento">Enrutamiento</a>
      </li>
      <li>
        <a href="#petición">Petición</a>
      </li>
      <li>
        <a href="#respuesta">Respuesta</a>
      </li>
      <li>
        <a href="#base-de-datos">Base de datos</a>
      </li>
      <li>
        <a href="#sesión">Sesión</a>
      </li>
    </ul>

    <h2 id="contenedor-de-la-aplicación-1">Contenedor de la aplicación</h2>

    <ul>
      <li>
        <a href="enlazando-servicios">Enlazando servicios</a>
      </li>
      <li>
        <a href="accediendo-a-servicios">Accediendo a servicios</a>
      </li>
    </ul>

    <p>El contenedor de la aplicación de Dawn es la base del framework. En él se contiene la aplicación, los servicios y se
      prepara y ejecuta la aplicación. Se puede acceder a él con la función
      <code class="highlighter-rouge">app</code>. También es una propiedad de los controladores.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$app</span> <span class="o">=</span> <span class="nx">app</span><span class="p">();</span>
</code></pre>
      </div>
    </div>

    <h3 id="enlazando-servicios">Enlazando servicios</h3>

    <p>Para enlazar servicios al contenedor existe el método
      <code class="highlighter-rouge">bind</code>.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">serviceName</code>
            </strong>
          </td>
          <td>El nombre del servicio.</td>
          <td>
            <em>El servicio se llama
              <code class="highlighter-rouge">router</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">service</code>
            </strong>
          </td>
          <td>The service instance.</td>
          <td>
            <em>La instancia del servicio es
              <code class="highlighter-rouge">$router</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$app</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">bind</span><span class="p">(</span><span class="s1">'router'</span><span class="p">,</span> <span class="nv">$router</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h3 id="accediendo-a-servicios">Accediendo a servicios</h3>

    <p>Para acceder a los servicios enlazados al contenedor existe el método
      <code class="highlighter-rouge">get</code>. Espera como parámetro el nombre del servicio.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$router</span> <span class="o">=</span> <span class="nv">$app</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'router'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h2 id="proveedores-de-servicios-1">Proveedores de servicios</h2>

    <ul>
      <li>
        <a href="#creando-proveedores-de-servicios">Creando proveedores de servicios</a>
      </li>
      <li>
        <a href="#añadiendo-proveedores-de-servicios">Añadiendo proveedores de servicios</a>
      </li>
    </ul>

    <p>Los proveedores de servicios preparan y enlazan los servicios al contenedor de la aplicación. Los servicios contienen
      la logica de la aplicación externa a Dawn, asi se pueden añadir por ejemplo servicios de facturación, autorización,
      email…
    </p>

    <h3 id="creando-proveedores-de-servicios">Creando proveedores de servicios</h3>

    <p>Para crear un proveedor de servicio es necesario extender la clase
      <code class="highlighter-rouge">Dawn\App\ServiceProvider</code>.</p>

    <p>Los proveedores de servicio deben incluir los métodos
      <code class="highlighter-rouge">register</code> y
      <code class="highlighter-rouge">boot</code>.</p>

    <p>El método
      <code class="highlighter-rouge">register</code> debe encargarse únicamente de instanciar los servicios y enlazarlos al contenedor de la aplicación.</p>

    <p>El método
      <code class="highlighter-rouge">boot</code> se ejecuta una vez que todos los servicios han sido registrados, lo que significa que en el ya se puede acceder a
      los servicios del controlador, y puede contener toda la lógica necesaria para que los servicios puedan funcionar.</p>

    <p>En el siguiente ejemplo, se crea el proveedor de servicio ficticio
      <code class="highlighter-rouge">HelloWorldServiceProvider</code>.</p>

    <p>En su método
      <code class="highlighter-rouge">register</code> se instancia la clase
      <code class="highlighter-rouge">HelloWorld</code> y se enlaza al contenedor de la apliacación como
      <code class="highlighter-rouge">hello world</code>.</p>

    <p>En su método
      <code class="highlighter-rouge">boot</code> se recoge el servicio del contenedor de la aplicación con
      <code class="highlighter-rouge">$this-&gt;app-&gt;get('hello world')</code> y también se recoge el servicio ficticio
      <code class="highlighter-rouge">time</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">namespace</span> <span class="nx">App\HelloWorldServiceProvider</span><span class="p">;</span>

<span class="k">class</span> <span class="nc">HelloWorldServiceProvider</span> <span class="k">extends</span> <span class="nx">Dawn\App\ServiceProvider</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">register</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$helloWorld</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">HelloWorld</span><span class="p">()</span><span class="o">:</span>

    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">app</span><span class="o">-&gt;</span><span class="na">bind</span><span class="p">(</span><span class="s1">'hello world'</span><span class="p">,</span> <span class="nv">$helloWorld</span><span class="p">);</span>
  <span class="p">}</span>

  <span class="k">public</span> <span class="k">function</span> <span class="nf">boot</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$helloWorld</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">app</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'hello world'</span><span class="p">);</span>
    <span class="nv">$time</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">app</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'time'</span><span class="p">);</span>

    <span class="k">die</span><span class="p">(</span><span class="s2">"</span><span class="si">{</span><span class="nv">$helloWorld</span><span class="o">-&gt;</span><span class="na">sayHi</span><span class="p">()</span><span class="si">}</span><span class="s2"> it is </span><span class="si">{</span><span class="nv">$time</span><span class="o">-&gt;</span><span class="na">now</span><span class="p">()</span><span class="si">}</span><span class="s2">"</span><span class="p">);</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="añadiendo-proveedores-de-servicios">Añadiendo proveedores de servicios</h3>

    <p>Los proveedores de servicios se añaden en el apartado
      <code class="highlighter-rouge">service providers</code> del archivo
      <code class="highlighter-rouge">config.php</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="s1">'service providers'</span> <span class="o">=&gt;</span> <span class="p">[</span>
  <span class="s1">'database'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Database\\DatabaseServiceProvider'</span><span class="p">,</span>
  <span class="s1">'router'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Routing\\RoutingServiceProvider'</span><span class="p">,</span>
  <span class="s1">'session'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Session\\SessionServiceProvider'</span><span class="p">,</span>
  <span class="s1">'auth'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Auth\\AuthServiceProvider'</span>
<span class="p">]</span>
</code></pre>
      </div>
    </div>

    <p>Para añadir un proveedor de servicio simplemente incluye su nombre y el namespace completo de su clase.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="s1">'service providers'</span> <span class="o">=&gt;</span> <span class="p">[</span>
  <span class="s1">'database'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Database\\DatabaseServiceProvider'</span><span class="p">,</span>
  <span class="s1">'router'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Routing\\RoutingServiceProvider'</span><span class="p">,</span>
  <span class="s1">'session'</span> <span class="o">=&gt;</span> <span class="s1">'\\Dawn\\Session\\SessionServiceProvider'</span><span class="p">,</span>
  <span class="s1">'hello world'</span> <span class="o">=&gt;</span> <span class="s1">'\\App\\HelloWorldServiceProvider'</span>
<span class="p">]</span>
</code></pre>
      </div>
    </div>

    <h2 id="modelos">Modelos</h2>

    <ul>
      <li>
        <a href="#recomendaciones">Recomendaciones</a>
      </li>
      <li>
        <a href="#creando-modelos">Creando modelos</a>
      </li>
      <li>
        <a href="#modificando-propiedades-predeterminadas">Modificando propiedades predeterminadas</a>
      </li>
      <li>
        <a href="#ocultando-propiedades-en-respuestas-json">Ocultando propiedades en respuestas JSON</a>
      </li>
      <li>
        <a href="#recogiendo-registros-de-la-base-de-datos">Recogiendo registros de la base de datos</a>
      </li>
    </ul>

    <p>Los modelos son las clases encargadas de interactuar con la base de datos. Para ello, tienen acceso al constructor de
      consultas además de una serie de métodos predefinidos que facilitan algunas de las consultas más habituales.</p>

    <h3 id="recomendaciones">Recomendaciones</h3>

    <p>Para que Dawn funcione sin necesidad de hacer ajustes, es aconsejable que se sigan las siguientes recomendaciones:</p>

    <ul>
      <li>
        <p>La tabla de la base de datos debería tener el nombre del modelo en plural. Por ejemplo, para crear una tabla que
          contenga los datos de unos mensajes, el nombre de la tabla debería ser
          <code class="highlighter-rouge">messages</code>.</p>
      </li>
      <li>
        <p>La clase del modelo debería tener un nombre en singular. Por ejemplo, para la tabla
          <code class="highlighter-rouge">messages</code>, el nombre de la clase debería ser
          <code class="highlighter-rouge">message</code>.</p>
      </li>
      <li>
        <p>La clave primaria debería ser la columna
          <code class="highlighter-rouge">id</code>.</p>
      </li>
      <li>
        <p>El nombre de las propiedades debería ser identico a columna de referencia en la tabla. Por ejemplo, si la clave primaria
          es la columna
          <code class="highlighter-rouge">post_id</code>, el nombre de la propiedad de la clase también debería ser
          <code class="highlighter-rouge">post_id</code>.</p>
      </li>
    </ul>

    <h3 id="creando-modelos">Creando modelos</h3>

    <p>Los modelos de la aplicación deberían ser creados en el directorio
      <code class="highlighter-rouge">app/models</code>, pertenecer al namespace
      <code class="highlighter-rouge">App\Models</code> y extender de la clase
      <code class="highlighter-rouge">App\Models\Model</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">namespace</span> <span class="nx">App\Models</span><span class="p">;</span>

<span class="k">class</span> <span class="nc">Post</span> <span class="k">extends</span> <span class="nx">Model</span>
<span class="p">{</span> 
  <span class="k">protected</span> <span class="nv">$title</span><span class="p">;</span>
  <span class="k">protected</span> <span class="nv">$body</span><span class="p">;</span>

  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="modificando-propiedades-predeterminadas">Modificando propiedades predeterminadas</h3>

    <p>Los modelos heredan las siguientes propiedades del modelo base de Dawn:</p>

    <table>
      <thead>
        <tr>
          <th>Propiedad</th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">queryBuilder</code>
            </strong>
          </td>
          <td>Instancia del constructor de consultas.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">table</code>
            </strong>
          </td>
          <td>El nombre de la tabla de la base de datos a la que pertenece el modelo. Por defecto es el nombre del modelo seguido
            de la letra ‘s’.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">primaryKey</code>
            </strong>
          </td>
          <td>El nombre de la columna que actúa como clave primaria en la base de datos. Por defecto es
            <code class="highlighter-rouge">id</code>.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">id</code>
            </strong>
          </td>
          <td>La columna
            <code class="highlighter-rouge">id</code> de la tabla.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">owner</code>
            </strong>
          </td>
          <td>El
            <code class="highlighter-rouge">id</code> del propietario del registro, en caso de que tenga uno.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">visible</code>
            </strong>
          </td>
          <td>Array de propiedades a mostrar en una respuesta JSON.</td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">hidden</code>
            </strong>
          </td>
          <td>Array de propiedades a ocultar en una respuesta JSON.</td>
        </tr>
      </tbody>
    </table>

    <p>En caso de que el nombre de la tabla o la clave primaria sean diferentes a los definidos por defecto, es necesario sobreescribir
      sus propiedades en el constructor.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">Post</span> <span class="k">extends</span> <span class="nx">Model</span>
<span class="p">{</span>
  <span class="k">protected</span> <span class="nv">$post_id</span><span class="p">;</span>
  <span class="k">protected</span> <span class="nv">$title</span><span class="p">;</span>
  <span class="k">protected</span> <span class="nv">$body</span><span class="p">;</span>

  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">table</span> <span class="o">=</span> <span class="s1">'my_posts'</span><span class="p">;</span>
    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">primaryKey</span> <span class="o">=</span> <span class="s1">'post_id'</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>Ten en cuenta que al haber modificado la clave primaria, ha sido necesario añadir la propiedad
      <code class="highlighter-rouge">post_id</code> a la clase.</p>

    <h3 id="ocultando-propiedades-en-respuestas-json">Ocultando propiedades en respuestas JSON</h3>

    <p>Es posible ocultar datos sensibles o innecesarios en las respuestas enviadas en formato JSON, tales como contraseñas
      o emails.</p>

    <p>Para ello, utiliza el método
      <code class="highlighter-rouge">hidden</code> en el constructor del modelo. Este método espera como parámetro un array de los nombres de las propiedades que se
      quieren ocultar.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">Post</span> <span class="k">extends</span> <span class="nx">Model</span>
<span class="p">{</span>
  <span class="k">protected</span> <span class="nv">$post_id</span><span class="p">;</span>
  <span class="k">protected</span> <span class="nv">$title</span><span class="p">;</span>
  <span class="k">protected</span> <span class="nv">$body</span><span class="p">;</span>

  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">table</span> <span class="o">=</span> <span class="s1">'my_posts'</span><span class="p">;</span>
    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">primaryKey</span> <span class="o">=</span> <span class="s1">'post_id'</span><span class="p">;</span>
    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">hidden</span><span class="p">([</span><span class="s1">'post_id'</span><span class="p">]),</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>También es posible que en algún momento sea necesario mostrar datos que habían sido ocultados, por ejemplo al hacer que
      una clase herede de otra.</p>

    <p>Para ello, utiliza el método
      <code class="highlighter-rouge">visible</code> de la misma forma.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">Comment</span> <span class="k">extends</span> <span class="nx">Post</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
    <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">visible</span><span class="p">[</span><span class="s1">'post_id'</span><span class="p">];</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>Con esto se consigue que al enviar una respuesta con un objeto de la clase
      <code class="highlighter-rouge">Post</code>, la propiedad
      <code class="highlighter-rouge">post_id</code> sea ocultada. Sin embargo, al enviar una respuesta con un objeto de la clase
      <code class="highlighter-rouge">Comment</code>, la propiedad
      <code class="highlighter-rouge">post_id</code> se hace visible de nuevo.</p>

    <h3 id="recogiendo-registros-de-la-base-de-datos">Recogiendo registros de la base de datos</h3>

    <p>Los modelos de Dawn, además de incluir el constructor de consultas como propiedad, tienen métodos para hacer algunas
      de las consultas más comunes.</p>

    <p>
      <strong>
        <code class="highlighter-rouge">all</code>
      </strong> -
      <em>Devuelve un array de instancias del modelo por cada registro de la tabla (
        <code class="highlighter-rouge">SELECT * FROM table</code>)</em>
    </p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

<span class="nv">$posts</span> <span class="o">=</span> <span class="nv">$postModel</span><span class="o">-&gt;</span><span class="na">all</span><span class="p">();</span>
</code></pre>
      </div>
    </div>

    <p>
      <strong>
        <code class="highlighter-rouge">find</code>
      </strong> -
      <em>Devuelve una instancia de un registro de la tabla (
        <code class="highlighter-rouge">SELECT * FROM table WHERE id=x</code>)</em>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">primaryKey</code>
            </strong>
          </td>
          <td>ID del registro.</td>
          <td>
            <em>Obtener el registro con ID igual a
              <code class="highlighter-rouge">5</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

<span class="nv">$posts</span> <span class="o">=</span> <span class="nv">$postModel</span><span class="o">-&gt;</span><span class="na">find</span><span class="p">(</span><span class="mi">5</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <p>
      <strong>
        <code class="highlighter-rouge">getBy</code>
      </strong> -
      <em>Devuelve un array de instancias del modelo bajo un filtro</em>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">key</code>
            </strong>
          </td>
          <td>Nombre de la columna a filtrar.</td>
          <td>
            <em>Obtener donde la columna
              <code class="highlighter-rouge">title</code> sea igual a algo</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">value</code>
            </strong>
          </td>
          <td>Valor del filtro.</td>
          <td>
            <em>Obtener donde el valor del registro en esa columna sea
              <code class="highlighter-rouge">Hello World</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

<span class="nv">$posts</span> <span class="o">=</span> <span class="nv">$postModel</span><span class="o">-&gt;</span><span class="na">getBy</span><span class="p">(</span><span class="s1">'title'</span><span class="p">,</span> <span class="s1">'Hello World'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <p>
      <strong>
        <code class="highlighter-rouge">getColumnBy</code>
      </strong> -
      <em>Devuelve un único campo de la tabla del modelo bajo un filtro por columna.</em>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">column</code>
            </strong>
          </td>
          <td>Nombre de la columna de la que obtener el valor.</td>
          <td>
            <em>Obtener un valor de la columna
              <code class="highlighter-rouge">body</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">key</code>
            </strong>
          </td>
          <td>Nombre de la columna a filtrar.</td>
          <td>
            <em>Obtener donde la columna
              <code class="highlighter-rouge">title</code> sea igual a algo</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">value</code>
            </strong>
          </td>
          <td>Valor del filtro.</td>
          <td>
            <em>Obtener donde el valor del registro en esa columna sea
              <code class="highlighter-rouge">Hello World</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

<span class="nv">$body</span> <span class="o">=</span> <span class="nv">$postModel</span><span class="o">-&gt;</span><span class="na">getColumnBy</span><span class="p">(</span><span class="s1">'body'</span><span class="p">,</span> <span class="s1">'title'</span><span class="p">,</span> <span class="s1">'Hello World'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h2 id="controladores">Controladores</h2>

    <ul>
      <li>
        <a href="#creando-controladores">Creando controladores</a>
      </li>
      <li>
        <a href="#accediendo-a-los-servicios">Accediendo a los servicios</a>
      </li>
    </ul>

    <p>Los controladores son los encargados de utilizar los servicios y modelos necesarios para cumplir con la demanda de la
      petición, además de enviar una respuesta o mostrar una vista.</p>

    <h3 id="creando-controladores">Creando controladores</h3>

    <p>Los controladores de la aplicación deberían ser creados en el directorio
      <code class="highlighter-rouge">app/controllers</code>, pertenecer al namespace
      <code class="highlighter-rouge">App\Controllers</code> y extender de la clase
      <code class="highlighter-rouge">App\Controllers\Controllers</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">namespace</span> <span class="nx">App\Controllers</span><span class="p">;</span>

<span class="k">class</span> <span class="nc">PostController</span> <span class="k">extends</span> <span class="nx">Controller</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="accediendo-a-los-servicios">Accediendo a los servicios</h3>

    <p>Los servicios del contenedor de la aplicación pueden ser accedidos desde el método
      <code class="highlighter-rouge">get</code> de la aplicación.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">PostController</span> <span class="k">extends</span> <span class="nx">Controller</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
  <span class="p">}</span>

  <span class="k">public</span> <span class="k">function</span> <span class="nf">index</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$helloWorld</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">app</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'hello world'</span><span class="p">);</span>

    <span class="k">return</span> <span class="nv">$helloWorld</span><span class="o">-&gt;</span><span class="na">sayHi</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h2 id="vistas">Vistas</h2>

    <ul>
      <li>
        <a href="#creando-vistas">Creando vistas</a>
      </li>
      <li>
        <a href="#mostrando-vistas">Mostrando vistas</a>
      </li>
      <li>
        <a href="#accediendo-a-los-datos-de-la-vista">Accediendo a los datos de la vista</a>
      </li>
      <li>
        <a href="#añadiendo-enlaces-a-archivos">Añadiendo enlaces a archivos</a>
      </li>
    </ul>

    <p>Las vistas de Dawn son plantillas HTML que muestran los datos obtenidos del controlador.</p>

    <h3 id="creando-vistas">Creando vistas</h3>

    <p>Las vistas de la aplicación deberían ser creadas en el directorio
      <code class="highlighter-rouge">app/views</code> con un nombre de archivo acabado en
      <code class="highlighter-rouge">.view.php</code>.</p>

    <h3 id="mostrando-vistas">Mostrando vistas</h3>

    <p>Para mostrar vistas desde un controlador, se puede utilizar la función
      <code class="highlighter-rouge">view</code>.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">name</code>
            </strong>
          </td>
          <td>Nombre de la vista (excluyendo
            <code class="highlighter-rouge">.view.php</code>).</td>
          <td>
            <em>Para mostrar la vista localizada en
              <code class="highlighter-rouge">app/views/index.view.php</code>, el parámetro name es
              <code class="highlighter-rouge">index</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">data</code>
            </strong>
          </td>
          <td>Array de datos a pasar a la vista, donde la key es el nombre de la variable por la que se quiere acceder, y el
            valor es el valor del dato.</td>
          <td>
            <em>Para pasar la variable
              <code class="highlighter-rouge">$post</code>, el valor del parámetro es
              <code class="highlighter-rouge">['post' =&gt; $post]</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">PostController</span> <span class="k">extends</span> <span class="nx">Controller</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">();</span>
  <span class="p">}</span>

  <span class="k">public</span> <span class="k">function</span> <span class="nf">index</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

    <span class="nv">$post</span> <span class="o">=</span> <span class="nv">$postModel</span><span class="o">-&gt;</span><span class="na">find</span><span class="p">(</span><span class="mi">1</span><span class="p">);</span>

    <span class="k">return</span> <span class="nx">view</span><span class="p">(</span><span class="s1">'index'</span><span class="p">,</span> <span class="p">[</span><span class="s1">'post'</span> <span class="o">=&gt;</span> <span class="nv">$post</span><span class="p">]);</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>Es posible utilizar la función
      <code class="highlighter-rouge">compact</code> para hacer el paso de datos más sencillo:</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">public</span> <span class="k">function</span> <span class="nf">index</span><span class="p">()</span>
<span class="p">{</span>
  <span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

  <span class="nv">$post</span> <span class="o">=</span> <span class="nv">$postModel</span><span class="o">-&gt;</span><span class="na">find</span><span class="p">(</span><span class="mi">1</span><span class="p">);</span>

  <span class="k">return</span> <span class="nx">view</span><span class="p">(</span><span class="s1">'index'</span><span class="p">,</span> <span class="nb">compact</span><span class="p">(</span><span class="s1">'post'</span><span class="p">));</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>Las vistas pueden estar contenidas en directorios, por ejemplo podemos encontrar la vista
      <code class="highlighter-rouge">app/views/post/index.view.php</code>. En este caso, el valor del parámetro
      <code class="highlighter-rouge">name</code> sería
      <code class="highlighter-rouge">post/index</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nx">view</span><span class="p">(</span><span class="s1">'post/index'</span><span class="p">,</span> <span class="nb">compact</span><span class="p">(</span><span class="s1">'post'</span><span class="p">));</span>
</code></pre>
      </div>
    </div>

    <h3 id="accediendo-a-los-datos-de-la-vista">Accediendo a los datos de la vista</h3>

    <p>Los datos de la vista son accesibles desde la variable con el nombre correspondiente al pasado por el método
      <code class="highlighter-rouge">view</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nx">view</span><span class="p">(</span><span class="s1">'post/index'</span><span class="p">,</span> <span class="nb">compact</span><span class="p">(</span><span class="s1">'post'</span><span class="p">));</span>
</code></pre>
      </div>
    </div>

    <p>En este caso, en la vista existirá la variable
      <code class="highlighter-rouge">$post</code>:</p>

    <div class="language-html highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nt">&lt;div&gt;</span>
  <span class="nt">&lt;h1&gt;</span><span class="cp">&lt;?php echo $post-&gt;getTitle() ?&gt;</span><span class="nt">&lt;/h1&gt;</span>
  <span class="nt">&lt;p&gt;</span><span class="cp">&lt;?php echo $post-&gt;getBody() ?&gt;</span><span class="nt">&lt;/p&gt;</span>
<span class="nt">&lt;/div&gt;</span>
</code></pre>
      </div>
    </div>

    <h3 id="añadiendo-enlaces-a-archivos">Añadiendo enlaces a archivos</h3>

    <p>Para añadir enlaces a archivos tales como hojas de estilo, scripts o imágenes, siempre es necesario especificar la ruta
      completa desde la raíz de Dawn.</p>

    <p>Por ejemplo, para una hoja de estilo localizada en
      <code class="highlighter-rouge">app/views/assets/style.css</code>:</p>

    <div class="language-html highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nt">&lt;link</span> <span class="na">rel=</span><span class="s">"stylesheet"</span> <span class="na">href=</span><span class="s">"/app/views/assets/style.css"</span><span class="nt">&gt;</span>
</code></pre>
      </div>
    </div>

    <h2 id="enrutamiento">Enrutamiento</h2>

    <ul>
      <li>
        <a href="#añadiendo-rutas">Añadiendo rutas</a>
      </li>
      <li>
        <a href="#protegiendo-rutas">Protegiendo rutas</a>
      </li>
    </ul>

    <p>El enrutamiento es manejado por el servicio de enrutamiento de Dawn. Incluye un router para encargarse de la petición
      y la respuesta, rutas personalizadas y un controlador base.</p>

    <h3 id="añadiendo-rutas">Añadiendo rutas</h3>

    <p>Las rutas son establecidas en
      <code class="highlighter-rouge">app/routes/web.php</code> y
      <code class="highlighter-rouge">app/routes/api.php</code>.</p>

    <p>Para añadir una ruta, simplemente llama el método
      <code class="highlighter-rouge">get</code>,
      <code class="highlighter-rouge">post</code>,
      <code class="highlighter-rouge">patch</code>,
      <code class="highlighter-rouge">put</code> o
      <code class="highlighter-rouge">delete</code> de la clase
      <code class="highlighter-rouge">Dawn\Routing\Router</code>.</p>

    <p>Estos métodos esperan los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">uri</code>
            </strong>
          </td>
          <td>La URI requerida por el usuario.</td>
          <td>
            <em>La ruta de login es
              <code class="highlighter-rouge">www.example.com/login</code>. Por lo tanto, la URI es
              <code class="highlighter-rouge">login</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">controller</code>
            </strong>
          </td>
          <td>El nombre del controlador que se encargará de la petición. Un controlador de Dawn válido pertenece al namespace
            <code class="highlighter-rouge">App\Controller</code>. El nombre del controlador debe ser el resto del namespace.</td>
          <td>
            <em>El nombre completo de
              <code class="highlighter-rouge">LoginController</code> es
              <code class="highlighter-rouge">App\Controllers\Auth\LoginController</code>. Por lo tanto, el nombre del controlador debe ser
              <code class="highlighter-rouge">Auth\LoginController</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">action</code>
            </strong>
          </td>
          <td>El nombre del método del controlador que se encargará de la petición.</td>
          <td>
            <em>El método
              <code class="highlighter-rouge">LoginController-&gt;showLoginForm()</code> es el encargado de mostrar una vista de formulario de login. Por lo tanto, la acción es
              <code class="highlighter-rouge">showLoginForm</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'login'</span><span class="p">,</span> <span class="s1">'Auth\LoginController'</span><span class="p">,</span> <span class="s1">'showLoginForm'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h3 id="protegiendo-rutas">Protegiendo rutas</h3>

    <p>Las rutas pueden ser protegidas gracias al servicio de autenticación de Dawn. Esto restringirá el acceso a usuarios que
      no tienen los permisos necesarios.</p>

    <p>Por defecto, las rutas están disponibles para todos los usuarios. Dawn ofrece la posibilidad de restringir el acceso
      a solo invitados (
      <code class="highlighter-rouge">guest</code>), solo usuarios autenticados (
      <code class="highlighter-rouge">auth</code>) y solo propietarios del recurso (
      <code class="highlighter-rouge">owner</code>).</p>

    <p>Para proteger una ruta determinada, simplemente llama al método
      <code class="highlighter-rouge">auth</code> sobre ella con el parámetro de restricción.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'login'</span><span class="p">,</span> <span class="s1">'Auth\LoginController'</span><span class="p">,</span> <span class="s1">'showLoginForm'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">auth</span><span class="p">(</span><span class="s1">'guest'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h2 id="petición">Petición</h2>

    <ul>
      <li>
        <a href="#accediendo-al-input-de-la-petición">Accediendo al input de la petición</a>
      </li>
      <li>
        <a href="#comprobando-si-el-valor-de-un-input-esta-vacío">Comprobando si el valor de un input está vacío</a>
      </li>
      <li>
        <a href="#obteniendo-la-dirección-ip-y-el-user-agent-de-la-petición">Obteniendo la dirección IP y el User Agent de la petición</a>
      </li>
    </ul>

    <p>La petición actual es accesible desde el router y desde el controlador que la maneja.</p>

    <h3 id="accediendo-al-input-de-la-petición">Accediendo al input de la petición</h3>

    <p>El input de la petición puede ser accedido con el método
      <code class="highlighter-rouge">input</code> del controlador:</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">credentials</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$credentials</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">();</span>

    <span class="k">return</span> <span class="nv">$credentials</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>Un valor de un único input también puede ser accedido pasando su key como parámetro al método
      <code class="highlighter-rouge">input</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">email</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$email</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'email'</span><span class="p">);</span>

    <span class="k">return</span> <span class="nv">$email</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="comprobando-si-el-valor-de-un-input-está-vacío">Comprobando si el valor de un input está vacío</h3>

    <p>Se puede comprobar si el valor de un input está vacío con el método
      <code class="highlighter-rouge">empty</code>:</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">email</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">empty</span><span class="p">(</span><span class="s1">'remember'</span><span class="p">))</span> <span class="p">{</span>
      <span class="k">return</span> <span class="s2">"The email can't be empty."</span><span class="p">;</span>
    <span class="p">}</span>
    
    <span class="nv">$email</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'email'</span><span class="p">);</span>
    
    <span class="k">return</span> <span class="nv">$email</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="obteniendo-la-dirección-ip-y-el-user-agent-de-la-petición">Obteniendo la dirección IP y el User Agent de la petición</h3>

    <p>La dirección y el User Agent de la petición puede ser accedido desde los métodos
      <code class="highlighter-rouge">ip</code> y
      <code class="highlighter-rouge">userAgent</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">requestInfo</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$ip</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">ip</span><span class="p">();</span>
    <span class="nv">$userAgent</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">userAgent</span><span class="p">();</span>

    <span class="k">return</span> <span class="s2">"IP Address: </span><span class="si">{</span><span class="nv">$ip</span><span class="si">}</span><span class="s2"> - User Agent: </span><span class="si">{</span><span class="nv">$userAgent</span><span class="si">}</span><span class="s2">"</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h2 id="respuesta">Respuesta</h2>

    <ul>
      <li>
        <a href="#enviando-una-respuesta-simple">Enviando una respuesta simple</a>
      </li>
      <li>
        <a href="#enviando-una-respuesta-completa">Enviando una respuesta completa</a>
      </li>
    </ul>

    <h3 id="enviando-una-respuesta-simple">Enviando una respuesta simple</h3>

    <p>Para enviar una respuesta simple, simplemente devuelve un valor o una vista.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">showLoginForm</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">return</span> <span class="nx">view</span><span class="p">(</span><span class="s1">'auth/login'</span><span class="p">);</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="enviando-una-respuesta-completa">Enviando una respuesta completa</h3>

    <ul>
      <li>
        <a href="#estableciendo-un-código-de-estado">Estableciendo un código de estado</a>
      </li>
      <li>
        <a href="#añadiendo-cabeceras">Añadiendo cabeceras</a>
      </li>
      <li>
        <a href="#añadiendo-una-cabecera-de-token-de-autenticación">Añadiendo una cabecera de token de autenticación</a>
      </li>
      <li>
        <a href="#añadiendo-datos">Añadiendo datos</a>
      </li>
      <li>
        <a href="#respuesta-json">Respuesta JSON</a>
      </li>
      <li>
        <a href="#usando-el-método-response-del-controlador">Usando el método response del controlador</a>
      </li>
    </ul>

    <p>Dawn incluye una clase Response (
      <code class="highlighter-rouge">Dawn\Routing\Response</code>) que permite enviar respuestas con cabeceras, cookies y otros datos adjuntos.</p>

    <p>Esto puede hacerse con la propiedad
      <code class="highlighter-rouge">response</code> del controlador y el método
      <code class="highlighter-rouge">response</code>. Diferentes métodos pueden ser encadenados y una vez que la respuesta está lista puede ser enviada con su método
      <code class="highlighter-rouge">send</code>.</p>

    <h4 id="estableciendo-un-código-de-estado">Estableciendo un código de estado</h4>

    <p>Establecer un código de estado puede ser fácilmente conseguido con el método
      <code class="highlighter-rouge">status</code> de la respuesta.</p>

    <p>Este método espera los siguientes parámetros.</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">code</code>
            </strong>
          </td>
          <td>Código de estado (número entero).</td>
          <td>
            <em>El recurso no ha sido encontrado, por lo tanto, el código de estado más adecuado es
              <code class="highlighter-rouge">404</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">message</code>
            </strong>
            <em>[opcional]</em>
          </td>
          <td>Mensaje de estado personalizado. Si un mensaje de estado no es pasado al método, Dawn intentará encontrar el mensaje
            correspondiente al código de estado.</td>
          <td>
            <em>El código de estado es
              <code class="highlighter-rouge">404</code>, asi que el mensaje de estádo será
              <code class="highlighter-rouge">Not Found</code> a no ser que sea sobreescrito.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">notFound</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="o">-&gt;</span><span class="na">status</span><span class="p">(</span><span class="s1">'404'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h4 id="añadiendo-cabeceras">Añadiendo cabeceras</h4>

    <p>Se pueden añadir cabeceras con el método
      <code class="highlighter-rouge">header</code> de la respuesta.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">name</code>
            </strong>
          </td>
          <td>El nombre de la cabecera.</td>
          <td>
            <em>Para enviar una cookie con la respuesta, es necesaria la cabecera
              <code class="highlighter-rouge">Set-Cookie</code>. Por lo tanto, el nombre de la cabecera es
              <code class="highlighter-rouge">Set-Cookie</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">value</code>
            </strong>
          </td>
          <td>El valor de la cabecera.</td>
          <td>
            <em>El nombre de la cookie es
              <code class="highlighter-rouge">color</code> y su valor es
              <code class="highlighter-rouge">red</code>. Por lo tanto, el valor de la cabecera es
              <code class="highlighter-rouge">color=red</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">addColor</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="o">-&gt;</span><span class="na">header</span><span class="p">(</span><span class="s1">'Set-Cookie'</span><span class="p">,</span> <span class="s1">'color=red'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h4 id="añadiendo-una-cabecera-de-token-de-autenticación">Añadiendo una cabecera de token de autenticación</h4>

    <p>Las cabeceras de token pueden ser añadidas con el método
      <code class="highlighter-rouge">token</code> de la respuesta.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">addToken</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="o">-&gt;</span><span class="na">token</span><span class="p">(</span><span class="s1">'xxxxxxxxxxxxxxxxxx'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h4 id="añadiendo-datos">Añadiendo datos</h4>

    <p>Los datos pueden ser añadidos a la respuesta con su método
      <code class="highlighter-rouge">data</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">addData</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$data</span> <span class="o">=</span> <span class="p">[</span>
      <span class="s1">'current_users'</span><span class="o">:</span> <span class="mi">2000</span><span class="p">,</span>
      <span class="s1">'max_users'</span><span class="o">:</span> <span class="mi">0500</span>
    <span class="p">];</span>

    <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="o">-&gt;</span><span class="na">data</span><span class="p">(</span><span class="nv">$data</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h4 id="respuesta-json">Respuesta JSON</h4>

    <p>Las respuestas JSON pueden ser enviadas con el método
      <code class="highlighter-rouge">json</code> de la respuesta.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">sendJson</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$data</span> <span class="o">=</span> <span class="p">[</span>
      <span class="s1">'current_users'</span><span class="o">:</span> <span class="mi">2000</span><span class="p">,</span>
      <span class="s1">'max_users'</span><span class="o">:</span> <span class="mi">0500</span>
    <span class="p">];</span>

    <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="o">-&gt;</span><span class="na">data</span><span class="p">(</span><span class="nv">$data</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">json</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h4 id="usando-el-método-response-del-controlador">Usando el método response del controlador</h4>

    <p>Las respuestas también pueden ser enviadas utilizando el método
      <code class="highlighter-rouge">response</code> del controlador.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">data</code>
            </strong>
          </td>
          <td>Los datos para ser enviados con la respuesta.</td>
          <td>
            <em>Los datos están contenidos en el array
              <code class="highlighter-rouge">$data</code>. Por lo tanto, el parámetro es
              <code class="highlighter-rouge">$data</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">statusCode</code>
            </strong>
            <em>[opcional]</em>
          </td>
          <td>El código de estado de la respuesta. Si no es pasado al método, será
            <code class="highlighter-rouge">200</code>.</td>
          <td>
            <em>El código de estado es
              <code class="highlighter-rouge">200</code>. Por lo tanto, no es necesario pasarlo al método.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">sendJson</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$data</span> <span class="o">=</span> <span class="p">[</span>
      <span class="s1">'current_users'</span><span class="o">:</span> <span class="mi">2000</span><span class="p">,</span>
      <span class="s1">'max_users'</span><span class="o">:</span> <span class="mi">0500</span>
    <span class="p">];</span>

    <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="p">(</span><span class="nv">$data</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">json</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h2 id="base-de-datos">Base de datos</h2>

    <ul>
      <li>
        <a href="#configuración">Configuración</a>
      </li>
      <li>
        <a href="#constructor-de-consultas">Constructor de consultas</a>
      </li>
    </ul>

    <p>El servicio de base de datos de Dawn funciona con MySQL y PDO. Ofrece un constructor de consultas (
      <code class="highlighter-rouge">Dawn\Database\QueryBuilder</code>) y una clase modelo base (
      <code class="highlighter-rouge">Dawn\Database\Model</code>) para hacer consultas a la base de datos y recoger resultados más fácil.</p>

    <h3 id="configuración">Configuración</h3>

    <p>Las credenciales deberían mantenerse privadas y seguras, por lo tanto son establecidas en el archivo
      <code class="highlighter-rouge">.env</code>. ¡Recuerda no hacer commit de este archivo!</p>

    <div class="language-ini highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="py">DB_NAME</span><span class="p">=</span><span class="s">"dawn"</span>
<span class="py">DB_USER</span><span class="p">=</span><span class="s">"root"</span>
<span class="py">DB_PASSWORD</span><span class="p">=</span><span class="s">""</span>
<span class="py">DB_CONNECTION</span><span class="p">=</span><span class="s">"localhost"</span>
</code></pre>
      </div>
    </div>

    <h3 id="constructor-de-consultas">Constructor de consultas</h3>

    <ul>
      <li>
        <a href="#ejecutando-consultas-puras">Ejecutando consultas puras</a>
      </li>
      <li>
        <a href="#recogiendo-resultados">Recogiendo resultados</a>
      </li>
      <li>
        <a href="#construyendo-consultas">Construyendo consultas</a>
      </li>
      <li>
        <a href="#ejecutando-consultas-construidas">Ejecutando consultas construidas</a>
      </li>
      <li>
        <a href="#limpiando-la-consulta">Limpiando la consulta</a>
      </li>
      <li>
        <a href="#obteniendo-el-último-id-insertado">Obteniendo el último ID insertado</a>
      </li>
    </ul>

    <p>El constructor de consultas de Dawn está incluido en el modelo de Dawn, pero también funciona como un servicio, por lo
      que es accesible desde el contenedor de la aplicación con su método
      <code class="highlighter-rouge">get</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$queryBuilder</span> <span class="o">=</span> <span class="nx">app</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'query builder'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h4 id="ejecutando-consultas-puras">Ejecutando consultas puras</h4>

    <p>Ejecutar consultas puras es posible gracias al método
      <code class="highlighter-rouge">exec</code>. Devuelve la instancia del constructor de consultas, por lo que es posible encadenar el método
      <code class="highlighter-rouge">fetch</code> para recoger los resultados.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$users</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">exec</span><span class="p">(</span><span class="s1">'SELECT * FROM users'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">fetch</span><span class="p">(</span><span class="s1">'array'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h4 id="recogiendo-resultados">Recogiendo resultados</h4>

    <p>El método
      <code class="highlighter-rouge">fetch</code> del constructor de consultas devuelve los resultados como objetos de una clase (
      <code class="highlighter-rouge">class</code>) (definida con el método
      <code class="highlighter-rouge">setModel</code>), como un array (
      <code class="highlighter-rouge">array</code>) o como una columna única (
      <code class="highlighter-rouge">column</code>) (si se consulta solo una columna de la tabla).</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="c1">// Recogiendo usuarios como objetos del modelo usuario
</span>
<span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">setModel</span><span class="p">(</span><span class="s1">'App\Models\User'</span><span class="p">);</span>

<span class="nv">$users</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">exec</span><span class="p">(</span><span class="s1">'SELECT * FROM users'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">fetch</span><span class="p">();</span> <span class="c1">// o fetch('class');
</span></code></pre>
      </div>
    </div>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="c1">// Recogiendo usuarios como array
</span>
<span class="nv">$users</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">exec</span><span class="p">(</span><span class="s1">'SELECT * FROM users'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">fetch</span><span class="p">(</span><span class="s1">'array'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="c1">// Recogiendo solo los emails
</span>
<span class="nv">$emails</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">exec</span><span class="p">(</span><span class="s1">'SELECT email FROM users'</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">fetch</span><span class="p">(</span><span class="s1">'column'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h4 id="construyendo-consultas">Construyendo consultas</h4>

    <p>Las consultas pueden ser construidas usando métodos en vez de SQL puro.</p>

    <p>Los siguientes métodos pueden ser utilizados:</p>

    <p>
      <strong>
        <code class="highlighter-rouge">select</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">columns</code>
            </strong>
          </td>
          <td>Array de columnas a seleccionar. Si se deja vacío, selecciona todas las columnas.</td>
          <td>
            <em>Para seleccionar las columnas
              <code class="highlighter-rouge">email</code> y
              <code class="highlighter-rouge">password</code> el valor del parámetro es
              <code class="highlighter-rouge">['email', 'password']</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">from</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">tables</code>
            </strong>
          </td>
          <td>Array de tablas desde las que hacer la selección. Si se deja vacío, selecciona todas las tablas.</td>
          <td>
            <em>Para seleccionar de la tabla
              <code class="highlighter-rouge">users</code> el valor del parámetro es
              <code class="highlighter-rouge">['users']</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">where</code>,
        <code class="highlighter-rouge">and</code> y
        <code class="highlighter-rouge">or</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">column</code>
            </strong>
          </td>
          <td>La columna a filtrar.</td>
          <td>
            <em>Filtrar la columna
              <code class="highlighter-rouge">email</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">operator</code>
            </strong>
          </td>
          <td>Operador de comparación. (=, !=, &lt;, &lt;=, &gt;, &gt;=, between, not between, in, not in, is, like, not like).</td>
          <td>
            <em>Para filtrar donde el valor es igual a algo, el valor del parámetro es
              <code class="highlighter-rouge">=</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">value</code>
            </strong>
          </td>
          <td>El valor a filtrar.</td>
          <td>
            <em>Filtrar
              <code class="highlighter-rouge">example@email.com</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">insert</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">table</code>
            </strong>
          </td>
          <td>La tabla en la que insertar valores.</td>
          <td>
            <em>Insertar en la tabla
              <code class="highlighter-rouge">users</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">data</code>
            </strong>
          </td>
          <td>Array de datos a insertar, donde la key es la columna y el valor es el valor a insertar.</td>
          <td>
            <em>Para insertar el usuario
              <code class="highlighter-rouge">example</code>, con email
              <code class="highlighter-rouge">example@email.com</code> y contraseña
              <code class="highlighter-rouge">123456</code>, el parámetro
              <code class="highlighter-rouge">data</code> es
              <code class="highlighter-rouge">['username' =&gt; 'example', 'email' =&gt; 'example@email.com', 'password' =&gt; '123456']</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">update</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">table</code>
            </strong>
          </td>
          <td>La tabla en la que actualizar valores.</td>
          <td>
            <em>Actualizar la tabla
              <code class="highlighter-rouge">users</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">data</code>
            </strong>
          </td>
          <td>Array de datos a actualizar, donde la key es la columna y el valor es el valor a actualizar.</td>
          <td>
            <em>Para actualizar el email a
              <code class="highlighter-rouge">updated@email.com</code> y la contraseña a
              <code class="highlighter-rouge">654321</code>, el parámetro
              <code class="highlighter-rouge">data</code> es
              <code class="highlighter-rouge">['email' =&gt; 'update@email.com', 'password' =&gt; '654321']</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">delete</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">table</code>
            </strong>
          </td>
          <td>La tabla en la que eliminar filas.</td>
          <td>
            <em>Eliminar filas de la tabla
              <code class="highlighter-rouge">users</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">orderBy</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">data</code>
            </strong>
          </td>
          <td>Array de datos por los que ordenar, donde la key es la columna y el valor es el orden (
            <code class="highlighter-rouge">asc</code> or
            <code class="highlighter-rouge">desc</code>).</td>
          <td>
            <em>Para ordernar por
              <code class="highlighter-rouge">username</code> y
              <code class="highlighter-rouge">email</code>
              <code class="highlighter-rouge">desc</code>, el parámetro
              <code class="highlighter-rouge">data</code> es
              <code class="highlighter-rouge">['username' =&gt; 'desc', 'email' =&gt; 'desc']</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <p>
      <strong>
        <code class="highlighter-rouge">groupBy</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">columns</code>
            </strong>
          </td>
          <td>Array de columnas por las que agrupar.</td>
          <td>
            <em>Para agrupar por
              <code class="highlighter-rouge">status</code>, el parámetro es
              <code class="highlighter-rouge">['status']</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <h4 id="ejecutando-consultas-construidas">Ejecutando consultas construidas</h4>

    <p>Las consulta es guardada en la instancia del constructor de consultas. Para comprobarla, se puede llamar al método
      <code class="highlighter-rouge">getQuery</code>.</p>

    <p>El método
      <code class="highlighter-rouge">exec</code> es utilizado sin parametros para ejecutar la consulta actual. Para recoger los resultados se puede encadenar el método
      <code class="highlighter-rouge">fetch</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">select</span><span class="p">([</span><span class="s1">'username'</span><span class="p">,</span> <span class="s1">'email'</span><span class="p">])</span>
  <span class="o">-&gt;</span><span class="na">from</span><span class="p">([</span><span class="s1">'users'</span><span class="p">])</span>
  <span class="o">-&gt;</span><span class="na">where</span><span class="p">(</span><span class="s1">'status'</span><span class="p">,</span> <span class="s1">'='</span><span class="p">,</span> <span class="s1">'online'</span><span class="p">);</span>

<span class="nv">$users</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">exec</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">fetch</span><span class="p">(</span><span class="s1">'array'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <p>Tambien existe el método atajo
      <code class="highlighter-rouge">get</code>, que ejecuta la consulta y recoge el resultado. Espera los mismos parametros que el método
      <code class="highlighter-rouge">fetch</code> (
      <code class="highlighter-rouge">class</code> por defecto).</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$users</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'array'</span><span class="p">);</span>
</code></pre>
      </div>
    </div>

    <h4 id="limpiando-la-consulta">Limpiando la consulta</h4>

    <p>El método
      <code class="highlighter-rouge">clear</code> permite limpiar la consulta y la sentencia preparada en caso necesario.</p>

    <p>También existen los métodos
      <code class="highlighter-rouge">clearQuery</code> y
      <code class="highlighter-rouge">clearPreparedStatement</code> para limpiarlos por separado.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">clear</span><span class="p">();</span>
</code></pre>
      </div>
    </div>

    <h4 id="obteniendo-el-último-id-insertado">Obteniendo el último ID insertado</h4>

    <p>El último ID insertado puede ser obtenido con el método
      <code class="highlighter-rouge">getLastInsertId</code>.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="nv">$data</span> <span class="o">=</span> <span class="p">[</span>
  <span class="s1">'username'</span> <span class="o">=&gt;</span> <span class="s1">'example'</span><span class="p">,</span>
  <span class="s1">'email'</span> <span class="o">=&gt;</span> <span class="s1">'example@email.com'</span><span class="p">,</span>
  <span class="s1">'password'</span> <span class="o">=&gt;</span> <span class="s1">'123456'</span>
<span class="p">];</span>

<span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">insert</span><span class="p">(</span><span class="s1">'users'</span><span class="p">,</span> <span class="nv">$data</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">exec</span><span class="p">();</span>

<span class="nv">$lastId</span> <span class="o">=</span> <span class="nv">$queryBuilder</span><span class="o">-&gt;</span><span class="na">getLastInsertId</span><span class="p">();</span>
</code></pre>
      </div>
    </div>

    <h2 id="autenticación">Autenticación</h2>

    <ul>
      <li>
        <a href="#logueando-usuarios">Logueando usuarios</a>
      </li>
      <li>
        <a href="#deslogueando-usuarios">Deslogueando usuarios</a>
      </li>
      <li>
        <a href="#registrando-usuarios">Registrando usuarios</a>
      </li>
      <li>
        <a href="#comprobando-la-autenticación">Comprobando la autenticación</a>
      </li>
    </ul>

    <p>La autenticación es manejada por el servicio Auth the Dawn. Está encargado del login, registro de usuarios y verificar
      que el usuario tiene los permisos requeridos. Interactua con los servicios de base de datos y sesión.</p>

    <p>Este servicio está implementado en
      <code class="highlighter-rouge">Dawn\Auth\Auth</code>.</p>

    <h3 id="logueando-usuarios">Logueando usuarios</h3>

    <p>El método
      <code class="highlighter-rouge">login</code> de la clase
      <code class="highlighter-rouge">Dawn\Auth\Auth</code> loguea a los usuarios. Verifica que las credenciales son válidas y autentica al usuario, generando un token JWT y
      entregándoselo al servicio de sesión.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parametro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">email</code>
            </strong>
          </td>
          <td>El email del usuario.</td>
          <td>
            <em>El email del usuario es
              <code class="highlighter-rouge">example@email.com</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">password</code>
            </strong>
          </td>
          <td>La contraseña del usuario.</td>
          <td>
            <em>La contraseña del usuario es
              <code class="highlighter-rouge">123456</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">login</span><span class="p">()</span>
  <span class="p">{</span>
      <span class="nv">$email</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'email'</span><span class="p">);</span>
      <span class="nv">$password</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'password'</span><span class="p">);</span>

      <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">login</span><span class="p">(</span><span class="nv">$email</span><span class="p">,</span> <span class="nv">$password</span><span class="p">);</span>

      <span class="k">return</span> <span class="nx">redirect</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>También es posible autenticar a un usuario con el método
      <code class="highlighter-rouge">authenticate</code>.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">token</code>
            </strong>
          </td>
          <td>Un token JWT válido.</td>
          <td>
            <em>El token es
              <code class="highlighter-rouge">xxxxxxxxxxxxxxxxxxxxxxxxxxx</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">expires</code>
            </strong>
          </td>
          <td>Tiempo de expiración en segundos.</td>
          <td>
            <em>El tiempo de expiración es
              <code class="highlighter-rouge">3600</code> segundos.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">authenticate</span><span class="p">()</span>
  <span class="p">{</span>
      <span class="nv">$token</span> <span class="o">=</span> <span class="s1">'xxxxxxxxxxxxxxxxxxxxxxxxxxx'</span><span class="p">;</span>
      <span class="nv">$expires</span> <span class="o">=</span> <span class="mi">3600</span><span class="p">;</span>

      <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">authenticate</span><span class="p">(</span><span class="nv">$token</span><span class="p">,</span> <span class="nv">$expires</span><span class="p">);</span>

      <span class="k">return</span> <span class="nx">redirect</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="deslogueando-usuarios">Deslogueando usuarios</h3>

    <p>El método
      <code class="highlighter-rouge">logout</code> de la clase
      <code class="highlighter-rouge">Dawn\Auth\Auth</code> desloguea al usuario, destruyendo su sesión.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">logout</span><span class="p">()</span>
  <span class="p">{</span>
      <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">logout</span><span class="p">();</span>

      <span class="k">return</span> <span class="nx">redirect</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="registrando-usuarios">Registrando usuarios</h3>

    <p>El método
      <code class="highlighter-rouge">register</code> de la clase
      <code class="highlighter-rouge">Dawn\Auth\Auth</code> registra usuarios. Verifica que es posible registrar un usuario con sus credenciales, lo registra y autentica.</p>

    <p>Espera los siguientes parámetros:</p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">email</code>
            </strong>
          </td>
          <td>El email del usuario.</td>
          <td>
            <em>El email del usuario es
              <code class="highlighter-rouge">example@email.com</code>.</em>
          </td>
        </tr>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">password</code>
            </strong>
          </td>
          <td>La contraseña del usuario.</td>
          <td>
            <em>La contraseña del usuario es
              <code class="highlighter-rouge">123456</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">RegisterController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">login</span><span class="p">()</span>
  <span class="p">{</span>
      <span class="nv">$email</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'email'</span><span class="p">);</span>
      <span class="nv">$password</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'password'</span><span class="p">);</span>

      <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">register</span><span class="p">(</span><span class="nv">$email</span><span class="p">,</span> <span class="nv">$password</span><span class="p">);</span>

      <span class="k">return</span> <span class="nx">redirect</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h3 id="comprobando-la-autenticación">Comprobando la autenticación</h3>

    <p>Dawn permite comprobar si el usuario actual está autenticado, es un invitado o es el propietario del recurso.</p>

    <p>
      <strong>
        <code class="highlighter-rouge">authenticated</code>
      </strong>
    </p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">login</span><span class="p">()</span>
  <span class="p">{</span>
      <span class="nv">$email</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'email'</span><span class="p">);</span>
      <span class="nv">$password</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">input</span><span class="p">(</span><span class="s1">'password'</span><span class="p">);</span>

      <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">login</span><span class="p">(</span><span class="nv">$email</span><span class="p">,</span> <span class="nv">$password</span><span class="p">);</span>

      <span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">authenticated</span><span class="p">())</span> <span class="p">{</span>
        <span class="k">return</span> <span class="s1">'You are logged in!'</span><span class="p">;</span>
      <span class="p">}</span>

      <span class="k">return</span> <span class="s1">'There was a problem with the login.'</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>
      <strong>
        <code class="highlighter-rouge">guest</code>
      </strong>
    </p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">showLoginForm</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">guest</span><span class="p">())</span> <span class="p">{</span>
      <span class="k">return</span> <span class="nx">view</span><span class="p">(</span><span class="s1">'auth/login'</span><span class="p">);</span>
    <span class="p">}</span>
    
    <span class="k">return</span> <span class="s1">'You are already authenticated'</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <p>
      <strong>
        <code class="highlighter-rouge">isOwner</code>
      </strong>
    </p>

    <table>
      <thead>
        <tr>
          <th>Parámetro</th>
          <th> </th>
          <th>Ejemplo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <strong>
              <code class="highlighter-rouge">element</code>
            </strong>
          </td>
          <td>El elemento a comprobar.</td>
          <td>
            <em>El elemento es
              <code class="highlighter-rouge">$post</code>.</em>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">PostController</span> <span class="k">extends</span> <span class="nx">Controller</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">showPost</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$postModel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Post</span><span class="p">();</span>

    <span class="nv">$post</span> <span class="o">=</span> <span class="nv">$post</span><span class="o">-&gt;</span><span class="na">queryBuilder</span>
      <span class="o">-&gt;</span><span class="na">select</span><span class="p">()</span>
      <span class="o">-&gt;</span><span class="na">from</span><span class="p">([</span><span class="s1">'posts'</span><span class="p">])</span>
      <span class="o">-&gt;</span><span class="na">where</span><span class="p">(</span><span class="s1">'id'</span><span class="p">,</span> <span class="s1">'='</span><span class="p">,</span> <span class="mi">1</span><span class="p">)</span>
      <span class="o">-&gt;</span><span class="na">get</span><span class="p">();</span>

    <span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">auth</span><span class="o">-&gt;</span><span class="na">isOwner</span><span class="p">(</span><span class="nv">$post</span><span class="p">))</span> <span class="p">{</span>
      <span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">response</span><span class="p">(</span><span class="nv">$post</span><span class="p">)</span><span class="o">-&gt;</span><span class="na">json</span><span class="p">()</span><span class="o">-&gt;</span><span class="na">send</span><span class="p">();</span>
    <span class="p">}</span>

    <span class="k">return</span> <span class="s1">'This is not your post.'</span><span class="p">;</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h2 id="sesión">Sesión</h2>

    <ul>
      <li>
        <a href="#configurando-la-sesión">Configurando la sesión</a>
      </li>
      <li>
        <a href="#obteniendo-el-token-de-la-cabecera">Obteniendo el token de la cabecera</a>
      </li>
    </ul>

    <p>La sesión es manejada por el servicio de sesión de Dawn, implementado en
      <code class="highlighter-rouge">Dawn\Session\Session</code>.</p>

    <h3 id="configurando-la-sesión">Configurando la sesión</h3>

    <p>La sesión puede configurarse en el apartado
      <code class="highlighter-rouge">session</code> del archivo
      <code class="highlighter-rouge">config.php</code>.</p>

    <p>Dawn ofrece modos de configuración para la sesión,
      <code class="highlighter-rouge">cookie</code>,
      <code class="highlighter-rouge">session</code> y
      <code class="highlighter-rouge">local storage</code>.</p>

    <p>El tiempo de expiración se especifica en segundos.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="s1">'session'</span> <span class="o">=&gt;</span> <span class="p">[</span>
    <span class="s1">'mode'</span> <span class="o">=&gt;</span> <span class="s1">'cookie'</span><span class="p">,</span>
    <span class="s1">'expires'</span> <span class="o">=&gt;</span> <span class="mi">864000</span>
<span class="p">]</span>
</code></pre>
      </div>
    </div>

    <p>
      <code class="highlighter-rouge">cookie</code> envía una cookie al cliente en una cabecera con el token de autenticación.</p>

    <p>
      <code class="highlighter-rouge">session</code> crea una sesión PHP en el servidor.</p>

    <p>
      <code class="highlighter-rouge">local storage</code> devuelve una respuesta que incluye el token en formato JSON cuando el usuario se loguea.</p>

    <h3 id="obteniendo-el-token-de-la-cabecera">Obteniendo el token de la cabecera</h3>

    <p>Para obtener el token de la cabecera, se puede utilizar el método
      <code class="highlighter-rouge">bearer</code> de la sesión.</p>

    <div class="language-php highlighter-rouge">
      <div class="highlight">
        <pre class="highlight"><code><span class="k">class</span> <span class="nc">LoginController</span> <span class="k">extends</span> <span class="nx">AuthController</span>
<span class="p">{</span>
  <span class="k">public</span> <span class="k">function</span> <span class="nf">getToken</span><span class="p">()</span>
  <span class="p">{</span>
    <span class="nv">$session</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">app</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s1">'session'</span><span class="p">);</span>

    <span class="k">return</span> <span class="nv">$session</span><span class="o">-&gt;</span><span class="na">bearer</span><span class="p">();</span>
  <span class="p">}</span>
<span class="p">}</span>
</code></pre>
      </div>
    </div>

    <h1 id="licencia">Licencia</h1>
    <p>Dawn está bajo
      <a href="https://github.com/diegocasillasdev/dawn/blob/master/LICENSE">Licencia MIT</a>.</p>

  </section>


</body>

</html>
