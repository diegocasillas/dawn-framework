<?php

class Comment extends Model
{
    protected $post;
    protected $author;
    protected $body;

    public function post($id)
    {
        $this->post = Post::find($id);
    }

    public static function getByPost($post)
    {
        $comment = new static;

        $sql = "SELECT * FROM {$comment->table} WHERE post={$post}";
        $statement = $comment->db->prepare($sql);
        $statement->bindParam(':table', $comment->table);

        $statement->execute();

        $comments = $statement->fetchAll(PDO::FETCH_CLASS);


        return $comments;
    }
}
