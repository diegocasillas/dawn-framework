<?php

class CommentController
{
    public function index()
    {
        $comments = Comment::all();

        return view('index', compact('comments'));
    }

    public function store($id)
    {
        $comment = new Comment();

        $comment->setPost($id);
        $comment->setBody($_REQUEST['body']);
        $comment->setAuthor('Anon');

        $comment->save();

        return redirect("posts/{$comment->getPost()}");
    }
}
