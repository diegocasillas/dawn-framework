<?php

class User extends Model
{
    protected $username;
    protected $password;

    public function __construct($username = null, $isAuthenticated = false)
    {
        parent::__construct();
        // $this->username = $username;
        // $this->isAuthenticated = $isAuthenticated;
    }

    public function id()
    {
        return $this->id;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

    public function create()
    {
        $sql = "INSERT INTO {$this->table}(username, password) VALUES('{$this->username}', '{$this->password}')";
        $this->db->exec($sql);

        $this->id = $this->db->lastInsertId();
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}