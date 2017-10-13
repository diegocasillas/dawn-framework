<?php

class PostController
{
    public function index()
    {
        $posts = Post::all();

        $posts = compact('posts');

        return view('index', $posts);
    }

    public function store()
    {
        $post = new Post();
        $post->publish();
    }

    public function show($id =2)
    {
        $post = Post::find($id);

        return require 'app/views/show.view.php';
    }
}
