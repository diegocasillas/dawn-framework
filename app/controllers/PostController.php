<?php

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

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
        $post->setAuthor(Auth::user()->username());

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

        $post = Post::find($id);


        return require 'app/views/posts/edit.view.php';
    }

    public function update($id)
    {
        $post = Post::find($id);

        $post->setTitle($_REQUEST['title']);
        $post->setBody($_REQUEST['body']);

        $post->update();

        return require 'app/views/posts/show.view.php';
    }

    public function vote($id)
    {
        $post = Post::find($id);

        $vote = (float)$_REQUEST['vote'];


        $post->setScore($post->calcScore($vote));

        $post->vote();

        return redirect("posts/{$post->getId()}");
    }


}
