<?php

namespace App\controller;

use App\controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->loadView("home");
    }
}
