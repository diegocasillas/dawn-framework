<?php

class PostController
{
    public function index()
    {
        $posts = Post::all();

        return view('index', compact('posts'));
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        $post = new Post();

        $post->setTitle($_REQUEST['title']);
        $post->setBody($_REQUEST['body']);
        $post->setAuthor('Anon');

        $post->save();

        return redirect();
    }

    public function show($id =2)
    {
        $post = Post::find($id);

        return require 'app/views/show.view.php';
    }
}
