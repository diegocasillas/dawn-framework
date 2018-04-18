<?php

namespace Dawn\Auth;

use Dawn\Routing\Controller;

abstract class AuthController extends Controller
{
    protected $session;

    public function init()
    {
        parent::init();

        $this->session = $this->app->get('session');
    }

    public function tokenResponse()
    {
        return $this->session->getTokenResponse();
    }
}