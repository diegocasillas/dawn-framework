<?php foreach ($post->getComments() as $comment) : ?>
    <li><?php echo $comment->body(); ?></li>
<?php endforeach; ?>
