<?php

class PostController
{
    public function index()
    {
        $posts = Post::all();

        $posts = array_reverse($posts);

        return view('posts/index', compact('posts'));
    }

    public function create()
    {
        return view('posts/create');
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

    public function show($id)
    {
        $post = Post::find($id);

        return require 'app/views/posts/show.view.php';
    }

    public function edit($id)
    {
        echo "edit";
    }
}
