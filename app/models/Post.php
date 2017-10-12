<?php


class Post extends Model
{
    protected $id;
    protected $author;
    protected $title;
    protected $body;
    protected $comments = [];

    public static function selectAll()
    {
        $post = new static;

        $sql = "SELECT * FROM posts";
        $statement = $post->db->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        die(var_dump($result));
        return $result;
    }

    public function publish()
    {
        $sql = "INSERT INTO posts(author, title, body) VALUES('Diego', 'Mi primer post', 'AYLMAO')";
        $this->db->exec($sql);
    }
}
