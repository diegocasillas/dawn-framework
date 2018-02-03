<!DOCTYPE html>
<html>
<head>
    <title>Miniframework</title>
    <link rel="stylesheet" href="http://localhost/miniframework/node_modules/bootstrap/dist/css/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="../"><?php echo Auth::user()->username() ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          <a href="logout"><button class="btn btn-danger ml-2 my-2 my-sm-0">Logout</button></a>
        </form>
      </div>
    </nav>

    <main role="main">

<div class="jumbotron">
        <div class="container">
          <h1 class="display-3"><?php echo $post->title() ?></h1>
          <p><?php echo $post->body() ?></p>
          <?php if (Auth::isOwner($post)) : ?>
            <p><a class="btn btn-primary btn-lg" href="<?php echo $post->id() ?>/edit" role="button">Edit &raquo;</a></p>
        <?php endif ?>
        </div>
      </div>

    </main>

    <footer class="container">
      <p>&copy; diegocasillasdev</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
  </body>
</html>