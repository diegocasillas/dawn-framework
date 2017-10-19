<!DOCTYPE html>
<html>
<head>
    <title>show</title>
</head>
<body>
    <h1><?php echo $post->getTitle(); ?></h1>

    <?php echo $post->getBody(); ?>

    <hr>

    <form action="/miniframework/posts/<?php echo $post->getId(); ?>/vote" method="post">
        <b>score: <div id="score"><?php echo $post->getScore() ?></div>&nbsp;</b><input type="number" name="vote" min="0" max="10" value="5">
        <input type="submit" value="Vote">
    </form>    
    <br>

    <a href="/miniframework/posts/<?php echo $post->getId() ?>/edit">Edit Post</a>

    <hr>

    <?php foreach ($post->getComments() as $comment) : ?>
        <ul><li><?php echo $comment->getBody(); ?></li></ul>
    <?php endforeach; ?>

    <div>
        <form action="/miniframework/posts/<?php echo $post->getId(); ?>" method="POST">
            <input type="text" name="body">
            <input type="submit" value="Submit">
        </form>
    </div>

    <hr>
    
    <a href="/miniframework">Back</a>
    <script>
    <?php require 'app/views/posts/script.js'; ?>
    </script>
</body>
</html>
