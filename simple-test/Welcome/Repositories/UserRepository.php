<?php

namespace Repositories;

use Models\User;
use Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function loginUser($username, $password)
    {
        try {
            $this->user->loginUser($username, $password);
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    public function registerUser($username, $password)
    {
        try {
            $this->user->registerUser($username, $password);
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
}
