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

    public function login()
    {
        if (isset($_POST['login'])) {
            // Get the form data
            $username = $_POST['username'];
            $password = $_POST['password'];
            // removes backslashes
            $username = stripslashes($username);
            $password = stripslashes($_REQUEST['password']);

            $this->userRepository->loginUser($username, $password);
        }
    }

    public function register()
    {
        if (isset($_POST['register'])) {
            // Get the form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->userRepository->registerUser($username, $password);
        }
    }
}
