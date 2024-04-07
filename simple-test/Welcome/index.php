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
        $patternBlog = '/blog\/id\/*\/(en|vn)/s';
        $detailBlog = preg_match($patternBlog, $resquestURI) == true;

        if ($requestMethod === 'GET') {
            switch ($resquestURI) {
                case '/':
                    require_once $pathView . 'Index.php';
                    break;
                case '/welcome':
                    require_once $pathView . 'Welcome.php';
                    break;
                case '/blog':
                    $dispatch = $this->resolve(Controllers\BlogController::class, []);
                    $dispatch->show();
                    break;
                case $detailBlog:
                    $dispatch = $this->resolve(Controllers\BlogController::class, []);
                    $dispatch->detail($_GET['id'], $_GET['language']);
                    break;
                case '/login':
                    require_once $pathView . 'Login.php';
                    break;
                case '/register':
                    require_once $pathView . 'Register.php';
                    break;
                case '/alterdb':
                    require_once $pathDatabase . 'AlterDB.php';
                    break;
                case '/task':
                    $dispatch = $this->resolve(Controllers\TaskController::class, []);
                    $dispatch->show();
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
                case '/blog/create':
                    $dispatch = $this->resolve(Controllers\BlogController::class, []);
                    $dispatch->create();
                    break;
                case '/blog/edit':
                    $dispatch = $this->resolve(Controllers\BlogController::class, []);
                    $dispatch->edit($_POST['id']);
                    break;
                case '/blog/delete':
                    $dispatch = $this->resolve(Controllers\BlogController::class, []);
                    $dispatch->delete($_POST['id']);
                    break;
                case '/task/create':
                    $dispatch = $this->resolve(Controllers\TaskController::class, []);
                    $dispatch->create();
                    break;
                case '/task/edit':
                    $dispatch = $this->resolve(Controllers\TaskController::class, []);
                    $dispatch->edit($_POST['id']);
                    break;
                case '/task/delete':
                    $dispatch = $this->resolve(Controllers\TaskController::class, []);
                    $dispatch->delete($_POST['id']);
                    break;

                default:
                    require_once $pathView . '404.php';
                    break;
            }
        }
    }
}

new Welcome();