<?php use Dawn\Auth\Auth; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <style>
        html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>
</head>

  <body class="text-center">
    <form action="edit" method="post" class="form-signin">
      <img class="mb-4" src="https://files.gamebanana.com/img/ico/sprays/lmoa.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Edit your post</h1>
      <label for="inputTitle" class="sr-only">Title</label>
      <input type="text" name="title" id="inputTitle" class="form-control" placeholder="Title" autofocus value="<?php echo $post->title() ?>">
      <label for="inputBody" class="sr-only">Body</label>
      <input type="text" name="body" id="inputBody" class="form-control" placeholder="Body" value="<?php echo $post->body() ?>">

      <button class="btn btn-lg btn-primary btn-block" type="submit">Edit</button>
    </form>
  </body>

</html>
