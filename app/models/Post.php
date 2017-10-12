<?php


class Post extends Model
{
    protected $author;
    protected $title;
    protected $body;
    protected $comments = [];

    public function publish()
    {
        $sql = "INSERT INTO posts(author, title, body) VALUES('Diego', 'Mi primer post', 'AYLMAO')";
        $this->db->exec($sql);
    }
}
