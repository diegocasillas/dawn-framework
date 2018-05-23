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
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }

      50% {
        -webkit-transform: scale3d(1.25, 1.25, 1.25);
        transform: scale3d(1.25, 1.25, 1.25);
      }

      to {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }
    }

    @keyframes pulse {
      from {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }

      50% {
        -webkit-transform: scale3d(1.25, 1.25, 1.25);
        transform: scale3d(1.25, 1.25, 1.25);
      }

      to {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
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
    <div class="animated fadeIn">
      <h1 class="project-name">Dawn</h1>
      <p align="center" class="logo">
        <img width="250" src="/app/views/home/assets/dawn.png" />
      </p>
      <h2 class="project-tagline">Framework PHP MVC para construir web apps y APIs</h2>

      <a href="documentation" class="btn">Documentación</a>
      <div class="animated infinite pulse">
        <img class="chevron" src="/app/views/home/assets/chevron-bottom.svg" />
      </div>
    </div>
  </section>
<body>
</html>
