<?php

class User extends Model
{
    public $username;
    public $password;
    public $isAuthenticated;

    public function __construct($username = null, $isAuthenticated = false)
    {
        parent::__construct();
        $this->username = $username;
        $this->isAuthenticated = $isAuthenticated;
    }

    public function id()
    {
        return $this->id;
    }

    public function username()
    {
        return $this->username;
    }

    public function isAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function authenticate()
    {
        $this->isAuthenticated = true;
    }

    public function logout()
    {
        $this->isAuthenticated = false;
    }

    public function create()
    {
        $sql = "INSERT INTO {$this->table}(username, password) VALUES('{$this->username}', '{$this->password}')";
        $this->db->execute($sql);

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