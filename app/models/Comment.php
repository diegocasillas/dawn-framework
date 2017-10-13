<?php

class Comment extends Model
{
    private $post;
    private $author;
    private $body;

    public function __construct()
    {
        parent::__construct();

        //set post
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost()
    {
        $this->post = Post::find();
    }

    public function getAuthor()
    {
        return $this->getAuthor();
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
}
