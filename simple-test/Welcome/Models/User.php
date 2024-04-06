<?php

namespace Models;

use Databases\Connection;

Class User extends Connection
{
    public function loginUser($username, $password): array
    {
        $result = [];

        // Escapes special characters in a string
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = mysqli_real_escape_string($this->conn, $password);

        // Prepare and bind the SQL statement
        $sql = "SELECT id, password FROM users WHERE username = ? and password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        // Execute the SQL statement
        $stmt->execute();

        // Check if the user exists
        if ($stmt->execute()) {
            // Set the session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;

            $result = [
                "message" => "Loggin successfully",
                "status" => "success"
            ];
        } else {
            $result = [
                "message" => "User not found",
                "status" => "fail"
            ];
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function registerUser($username, $password): array
    {
        $result = [];

        // Escapes special characters in a string
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = mysqli_real_escape_string($this->conn, $password);

        // Prepare and bind the SQL statement
        $sql = "INSERT into users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the result to variables
        $stmt->bind_param("ss", $username, $password);

        // Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "New records created successfully",
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
}
