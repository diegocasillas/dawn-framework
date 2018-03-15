<?php

namespace Dawn\Admin\Controllers;

use Dawn\Routing\Controller;

class AdminController extends Controller
{
    public function showAdminPanel()
    {
        $routes = app()->get('router')->getRoutes();

        return require 'Dawn/Admin/views/admin-panel.view.php';
    }
}