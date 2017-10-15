<?php

class CommentController
{
    public function index()
    {
        $comments = Comment::all();

        return view('index', compact('comments'));
    }

    public function store()
    {
        $comment = new Comment();

        $comment->setPost(23);
        $comment->setBody($_REQUEST['body']);
        $comment->setAuthor('Anon');

        $comment->save();

        die(var_dump($comment));
        return redirect("posts/{$comment->getPost()}");
    }
}
