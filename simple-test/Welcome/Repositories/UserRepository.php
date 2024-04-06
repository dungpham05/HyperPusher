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

    public function loginUser($username, $password): array
    {
        try {
            $result = $this->user->loginUser($username, $password);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function registerUser($username, $password): array
    {
        try {
            $result = $this->user->registerUser($username, $password);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }
}
