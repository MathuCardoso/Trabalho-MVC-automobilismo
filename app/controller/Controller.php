<?php

namespace App\controller;

use App;
use App\controller\ViewController;

require_once __DIR__ . "/../../configs/App.php";

class Controller
{
    protected function loadView(string $viewFile, array $var = [])
    {

        $viewFile = App::URL_VIEW  . "{$viewFile}.php";

        if (!file_exists($viewFile)) {
            echo "<h1>A view: <br> <em>{$viewFile}</em> <br> não existe!</h1>";
            return;
        }

        if (!empty($var)) {
            extract($var);
        }

        $view = new ViewController();

        require_once $viewFile;
    }
}
