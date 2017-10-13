<?php

class CommentController
{
    public function index()
    {
        $comments = Comment::all();

        return view('index', compact('comments'));
    }
}
