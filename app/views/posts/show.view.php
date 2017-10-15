<!DOCTYPE html>
<html>
<head>
    <title>show</title>
</head>
<body>
    <h1><?php echo $post->getTitle(); ?></h1>
    <?php echo $post->getBody(); ?>

    <div>
        <form action="/miniframework/posts/<?php echo $post->getId(); ?>" method="POST">
            <input type="text" name="body">
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
