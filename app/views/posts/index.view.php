<!DOCTYPE html>
<html>
<head>
    <title>Miniframework</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<body>
    <?php require 'app/views/partials/nav.view.php' ?>

    <h1>Bienvenido, <?php echo Auth::user()->username() ?></h1>
    <h1>Posts</h1>

    <ul>
        <?php foreach ($posts as $post) : ?>
            <div>
                <h2><a href="/miniframework/posts/<?php echo $post->getId(); ?>"><?php echo $post->getTitle(); ?></a> - <small><?php echo $post->userId(); ?></small></h2>
                <p><?php echo $post->getBody(); ?></p>

                <?php require 'app/views/comments/index.view.php' ?>
            </div>
        <?php endforeach; ?>
    </ul>

    <a href="logout">Logout</a>
</body>
</html>
