<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;

abstract class AuthController extends Controller
{
    protected $auth;
    protected $session;

    public function init()
    {
        parent::init();

        $this->auth = $this->app->get('auth');
        $this->session = $this->app->get('session');
    }

    public function tokenResponse()
    {
        return $this->session->getTokenResponse();
    }
}