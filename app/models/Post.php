<?php

namespace App\Models;

use Dawn\Database\Model;

class Post extends Model
{
    protected $user_id;
    protected $title;
    protected $body;
    protected $score;
    protected $votes;
    protected $user;
    protected $comments = [];

    public function __construct()
    {
        parent::__construct();

        // $this->setComments();
    }

    public function save()
    {
        $data = [
            'user_id' => $this->user_id,
            'title' => $this->title,
            'body' => $this->body
        ];

        $this->queryBuilder->insert($this->table, $data)->exec();

        $this->id = $this->queryBuilder->lastInsertId();
    }

    public function update()
    {
        $data = [
            'title' => $this->title,
            'body' => $this->body
        ];

        $this->queryBuilder->update('posts', $data)->where('id', '=', (int)$this->id)->exec();
    }

    public function addComment()
    {
        Comment::save($this);
    }

    public function vote()
    {
        $sql = "
            UPDATE posts
            SET score={$this->score}, votes={$this->votes} + 1
            WHERE id={$this->id}
        ";

        $this->db->exec($sql);
    }

    public function calcScore($vote)
    {
        $newScore = ($this->getScore() * $this->getVotes() + $vote) / ($this->getVotes() + 1);

        $this->setScore($newScore);

        return $this->getScore();
    }

    public function userId()
    {
        return $this->user_id;
    }

    public function user()
    {
        $this->setUser();
        return $this->user;
    }

    public function hidden()
    {
        return ['body', 'score'];
    }

    public function setUserId($userId)
    {
        $this->user_id = (int)$userId;
    }

    public function title()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function body()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getScore()
    {
        return round((float)$this->score, 2);
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getVotes()
    {
        return $this->votes;
    }

    public function getComments()
    {
        return $this->comments;
    }

    // public function setComments()
    // {
    //     $this->comments = (new Comment())->getBy('post_id', $this->id());
    // }

    public function setUser()
    {
        $this->user = (new User())->find($this->userId());
    }
}
