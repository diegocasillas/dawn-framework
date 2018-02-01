<?php

class User extends Model
{
    protected $username;
    protected $isAuthenticated;

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
}