<?php

namespace Services;

use Repositories\UserRepository;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(): array
    {
        $result = [];

        if (isset($_POST['login'])) {
            // Get the form data
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Removes backslashes
            $username = stripslashes($username);
            $password = stripslashes($_REQUEST['password']);
            // Removes spaces
            $username = trim($username);
            $password = trim($password);
            // Hash Password
            $password = md5($password);

            $result = $this->userRepository->loginUser($username, $password);

            $_SESSION['result'] = $result;
        }

        return $result;
    }

    public function register(): array
    {
        $result = [];

        if (isset($_POST['register'])) {
            // Get the form data
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Removes backslashes
            $username = stripslashes($username);
            $password = stripslashes($password);
            // Removes spaces
            $username = trim($username);
            $password = trim($password);
            // Hash Password
            $password = md5($password);

            $result = $this->userRepository->registerUser($username, $password);

            $_SESSION['result'] = $result;
        }

        return $result;
    }
}
