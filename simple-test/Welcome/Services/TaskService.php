<?php

namespace Services;

use Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function show()
    {
        $result = [];

        $result = $this->taskRepository->show();

        return $result;
    }

    public function create()
    {
        $result = [];

        if (isset($_POST['create'])) {
            // Get the form data
            $taskName = $_POST['task-name'];
            $userName = $_POST['user-name'];
            $startTime = $_POST['start-time'];
            $expireTime = $_POST['expire-time'];

            $result = $this->taskRepository->create($taskName, $userName, $startTime, $expireTime);
        }

        return $result;
    }

    public function edit($id)
    {
        $result = [];

        $result = $this->taskRepository->edit($id);

        return $result;
    }

    public function delete($id)
    {
        $result = [];

        $result = $this->taskRepository->delete($id);

        return $result;
    }

    public function getAllUser()
    {
        $result = [];

        $result = $this->taskRepository->getAllUser();

        return $result;
    }
}
