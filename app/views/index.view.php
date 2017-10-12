<!DOCTYPE html>
<html>
<head>
    <title>Miniframework</title>
</head>
<body>
    <h1>Posts</h1>

    <ul>
        <?php foreach ($posts as $post) : ?>
            <li><?php echo $post; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
