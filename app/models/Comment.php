<?php

class Comment extends Model
{
    public $post;
    public $author;
    public $body;

    public function __construct()
    {
        parent::__construct();
    }

}
