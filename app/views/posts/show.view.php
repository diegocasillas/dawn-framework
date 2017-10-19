<!DOCTYPE html>
<html>
<head>
    <title>show</title>
</head>
<body>
    <h1><?php echo $post->getTitle(); ?></h1>

    <?php echo $post->getBody(); ?>

    <hr>

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
</body>
</html>
