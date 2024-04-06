<?php

namespace Repositories;

interface UserRepositoryInterface
{
    public function loginUser($username, $password): array;
    public function registerUser($username, $password): array;
}
