<?php foreach ($post->getComments() as $comment) : ?>
    <li><?php echo $comment->getBody(); ?></li>
<?php endforeach; ?>
