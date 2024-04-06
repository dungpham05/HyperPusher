<?php

namespace Controllers;

use Services\TaskService;
use Services\AuthService;

class TaskController
{
    protected $taskService;
    protected $pathViewtask;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
        $this->pathViewtask = __DIR__ . '/../Views/Tasks';
    }

    public function show()
    {
        $tasks = $this->taskService->show();
        $userNames = $this->taskService->getAllUser();

        require_once $this->pathViewtask . '/Maintask.php';
    }

    public function create()
    {
        $this->taskService->create();

        header("Location: /task");
    }

    public function edit($id)
    {
        $this->taskService->edit($id);

        header("Location: /task");
    }

    public function delete($id)
    {
        $this->taskService->delete($id);

        header("Location: /task");
    }
}
