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

        return $response;
    }

    public function register()
    {
        $response = $this->authService->register();

        return $response;
    }
}
