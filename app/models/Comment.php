<?php

use Dawn\Database\Model;

class Comment extends Model
{
    private $postId;
    private $author;
    private $body;

    public function __construct()
    {
        parent::__construct();

        //set postId
    }

    public function save()
    {
        $sql = "
            INSERT INTO comments(post_id, author, body)
            VALUES({$this->postId}, '{$this->author}', '{$this->body}')
        ";

        $this->db->exec($sql);

        $this->id = $this->db->lastInsertId();
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($id)
    {
        $this->postId = $id;
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
