<?php

namespace Repositories;

interface TaskRepositoryInterface
{
    public function show();
    public function create($taskName, $userName, $startTime, $expireTime);
    public function edit($id);
    public function delete($id);
}
