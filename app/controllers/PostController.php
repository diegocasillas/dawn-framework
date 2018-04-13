<?php

namespace App\Controllers;

use App\Models\Post;
use Dawn\Auth\Auth;
use Dawn\Routing\Response;

class PostController extends Controller
{
    public $prueba = "asdads";

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = (new Post())->all();

        $posts = array_reverse($posts);

        return view('posts/index', compact('posts'));
    }

    public function apiIndex()
    {
        $posts = (new Post())->all();
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
        $post->setUserId(auth()->id());

        $post->save();

        return redirect();
    }

    public function show($id)
    {
        $post = (new Post())->find($id);

        return view('posts/show', compact('post'));
    }

    public function edit($id)
    {
        $post = (new Post())->find($id);
        return view('posts/edit', compact('post'));
    }

    public function update($id)
    {
        $post = (new Post())->find($id);

        $post->setTitle($_REQUEST['title']);
        $post->setBody($_REQUEST['body']);

        $post->update();

        return view('posts/show', compact('post'));
    }

    public function vote($id)
    {
        $post = (new Post())->find($id);

        $vote = (float)$_REQUEST['vote'];


        $post->setScore($post->calcScore($vote));

        $post->vote();

        return redirect("posts/{$post->getId()}");
    }

    public function api()
    {
        $post = new Post();

        return $this->response->data($post->all())->header('asdasd', 'hfdfsdf')->token('8yfsaoyfoadyfo')->json()->send();
    }
}
