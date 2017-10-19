<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit post</title>
</head>
<body>
    <form action="/miniframework/posts/<?php echo $post->getId() ?>/edit" method="POST">
        <input type="text" name="title" value="<?php echo $post->getTitle(); ?>">
        <textarea name="body" placeholder="<?php echo $post->getBody(); ?>"></textarea>
        <input type="submit" value="Edit">
    </form>
</body>
</html>