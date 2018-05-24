<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dawn</title>
  <link rel="stylesheet" href="/app/views/auth/assets/style.css">
  <link rel="stylesheet" href="/app/views/auth/assets/bootstrap.min.css">

  <style>
    .page-header {
      height: 100vh;
    }

    .vertical-center {
      top: 50%;
      position: relative;
      transform: translateY(-50%)
    }
  </style>

</head>

<body>
  <section class="page-header">
    <div class="vertical-center">
      <div class="animated fadeIn">
        <h1 class="project-name">Login</h1>
        <div class="container">
          <form action="login" method="post" class="mt-5 mb-5 col-5 mx-auto">
            <div class="form-group">
              <input type="text" name="username" class="form-control text-center" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control text-center" placeholder="Password">
            </div>
            <div class="form-group">
              <button type="submit" class="btn mt-3">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
