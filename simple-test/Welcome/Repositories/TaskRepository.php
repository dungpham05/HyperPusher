<?php

namespace Repositories;

use Models\Task;
use Models\User;
use Repositories\TaskRepositoryInterface;

class taskRepository implements TaskRepositoryInterface
{
    protected $task;
    protected $user;

    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    public function show()
    {
        try {
            $result = $this->task->getAlltask();
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function create($taskName, $userName, $startTime, $expireTime)
    {
        try {
            $result = $this->task->createTaskByContents($taskName, $userName, $startTime, $expireTime);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function edit($id)
    {
        try {
            $result = $this->task->editTaskById($id);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function delete($id)
    {
        try {
            $result = $this->task->deleteTaskById($id);
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }

    public function getAllUser()
    {
        try {
            $result = $this->user->getAllUser();
        } catch (\Throwable $th) {
            $result = [
                "message" => $th->getMessage(),
                "status" => "fail"
            ];
        }

        return $result;
    }
}
