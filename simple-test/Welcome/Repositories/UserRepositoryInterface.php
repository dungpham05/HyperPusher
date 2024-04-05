<?php

namespace Repositories;

interface UserRepositoryInterface
{
    public function loginUser($username, $password);
    public function registerUser($username, $password);
}
