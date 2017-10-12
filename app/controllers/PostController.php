<?php

class PostController
{
    public function index()
    {
        $posts = Post::list();

        return require 'app/views/index.view.php';
    }

    public function store()
    {
        $post = new Post();
        $post->publish();
    }
}
