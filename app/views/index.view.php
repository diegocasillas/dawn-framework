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
                <h2><?php echo $post->title ?> - <small><?php echo $post->author ?></small></h2>
                <p><?php echo $post->body ?></p>
            </div>
        <?php endforeach; ?>
    </ul>
</body>
</html>
