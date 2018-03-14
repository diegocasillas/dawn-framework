<?php

namespace App\Controllers;

use Dawn\Routing\Controller;
use App\Models\Post;
use Dawn\Auth\Auth;

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

    public function apiIndex()
    {
        $posts = Post::all();
        echo json_encode($posts);
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
        $post->setUserId(Auth::id());

        $post->save();

        return redirect();
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts/show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts/edit', compact('post'));
    }

    public function update($id)
    {
        $post = Post::find($id);

        $post->setTitle($_REQUEST['title']);
        $post->setBody($_REQUEST['body']);

        $post->update();

        return view('posts/show', compact('post'));
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
