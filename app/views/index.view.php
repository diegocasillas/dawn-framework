<!DOCTYPE html>
<html>
<head>
    <title>Miniframework</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>
<body>
    <h1>Posts</h1>

    <ul>
        <?php foreach ($posts as $post) : ?>
            <div>
                <h2><?php echo $post->getTitle(); ?> - <small><?php echo $post->getAuthor(); ?></small></h2>
                <p><?php echo $post->getBody(); ?></p>

                <?php foreach ($post->getComments() as $comment) : ?>
                    <li><?php echo $comment->getBody(); ?></li>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </ul>
</body>
</html>
