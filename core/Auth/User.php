<?php

class User
{
    protected $username;
    protected $isAuthenticated;

    public function __construct($username = null, $isAuthenticated = false)
    {
        $this->username = $username;
        $this->isAuthenticated = $isAuthenticated;
    }

    public function name()
    {
        return $this->name;
    }

    public function isAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function authenticate()
    {
        $this->isAuthenticated = true;
    }
}