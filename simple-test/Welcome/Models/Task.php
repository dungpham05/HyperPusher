<?php

namespace Models;

use Databases\Connection;

Class Task extends Connection
{
    public function getAllTask()
    {
        $result = [];

        // Prepare and bind the SQL statement
        $sql = "SELECT * FROM tasks";
        $stmt = $this->conn->query($sql);

        while ($row = $stmt->fetch_assoc()) {
            $result[] = $row;
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function getDetailTaskById($id)
    {
        $result = [];

        // Prepare and bind the SQL statement
        $sql = "SELECT * FROM tasks WHERE id = $id";
        $stmt = $this->conn->query($sql);

        while ($row = $stmt->fetch_assoc()) {
            $result = $row;
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function createTaskByContents($taskName, $userName, $startTime, $expireTime)
    {
        $result = [];

        $taskName = mysqli_real_escape_string($this->conn, $taskName);
        $userName = mysqli_real_escape_string($this->conn, $userName);
        $startTime = mysqli_real_escape_string($this->conn, $startTime);
        $expireTime = mysqli_real_escape_string($this->conn, $expireTime);
        $startTime = $startTime == "" ? null : $startTime;

        // Prepare and bind the SQL statement
        $sql = "INSERT into tasks (task_name, user_name, start_time, expire_time) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the result to variables
        $stmt->bind_param("ssss", $taskName, $userName, $startTime, $expireTime);

        // Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "New task created successfully",
                "status" => "success"
            ];
        } else {
            $result = [
                "message" => "an error occurred",
                "status" => "fail"
            ];
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function editTaskById($id)
    {
        $result = [];

        $taskName = mysqli_real_escape_string($this->conn, $_POST["task-name"]);
        $userName = mysqli_real_escape_string($this->conn, $_POST["user-name"]);
        $startTime = mysqli_real_escape_string($this->conn, $_POST["start-time"]);
        $expireTime = mysqli_real_escape_string($this->conn, $_POST["expire-time"]);
        $id = mysqli_real_escape_string($this->conn, $id);
        $startTime = $startTime == "" ? null : $startTime;

        // Prepare and bind the SQL statement
        $sql = "UPDATE tasks SET `task_name` = ?, `user_name` = ?, `start_time` = ?, `expire_time` = ? WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $taskName, $userName, $startTime, $expireTime, $id);

        // Execute the SQL statement && Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "Edited task successfully",
                "status" => "success"
            ];
        } else {
            $result = [
                "message" => "Edited fail",
                "status" => "fail"
            ];
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function deleteTaskById($id)
    {
        $result = [];

        $id = mysqli_real_escape_string($this->conn, $id);

        // Prepare and bind the SQL statement
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);

        // Execute the SQL statement && Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "Deleted task successfully",
                "status" => "success"
            ];
        } else {
            $result = [
                "message" => "Deleted fail",
                "status" => "fail"
            ];
        }

        // Close the connection
        $stmt->close();

        return $result;
    }
}
