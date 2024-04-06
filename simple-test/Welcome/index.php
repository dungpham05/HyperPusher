<?php

require __DIR__ . '/Includes/Autoload.php';

class Welcome extends Container
{
    public function __construct()
    {
        $this->route();
    }

    public function route()
    {
        $resquestURI = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $pathView = __DIR__ . '/Views/';
        $pathDatabase = __DIR__ . '/Databases/';

        if ($requestMethod === 'GET') {
            switch ($resquestURI) {
                case '/':
                    require_once $pathView . 'index.php';
                    break;
                case '/welcome':
                    require_once $pathView . 'welcome.php';
                    break;
                case '/login':
                    require_once $pathView . 'login.php';
                    break;
                case '/register':
                    require_once $pathView . 'register.php';
                    break;
                case '/alterdb':
                    require_once $pathDatabase . 'AlterDB.php';
                    break;

                default:
                    require_once $pathView . '404.php';
                    break;
            }

        } else if ($requestMethod === 'POST') {
            switch ($resquestURI) {
                case '/login':
                    $dispatch = $this->resolve(Controllers\AuthController::class, []);
                    $dispatch->login();
                    break;
                case '/register':
                    $dispatch = $this->resolve(Controllers\AuthController::class, []);
                    $dispatch->register();
                    break;

                default:
                    require_once $pathView . '404.php';
                    break;
            }
        }
    }
}

new Welcome();