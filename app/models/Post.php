<?php


class Post extends Model
{
    public $author;
    public $title;
    public $body;
    public $comments = [];

    public function __construct()
    {
        parent::__construct();
        $this->comments = Comment::getBy('post', $this->id);
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function save()
    {
        $sql = "
            INSERT INTO posts(author, title, body)
            VALUES('{$this->author}', '{$this->title}', '{$this->body}')
        ";
        $this->db->exec($sql);

        $this->id = $this->db->lastInsertId();
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
}
