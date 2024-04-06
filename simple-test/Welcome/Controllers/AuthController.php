<?php

namespace Controllers;

use Services\AuthService;

class AuthController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        session_start();
        $response = $this->authService->login();

        if (isset($response['status']) && $response['status'] === 'success') {
            header("Location: /welcome");
        } else {
            header("Location: /login");
        }
    }

    public function register()
    {
        session_start();
        $response = $this->authService->register();

        if (isset($response['status']) && $response['status'] === 'success') {
            header("Location: /login");
        } else {
            header("Location: /register");
        }
    }
}
