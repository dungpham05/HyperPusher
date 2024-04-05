<?php

namespace Models;

use Databases\Connection;

Class User extends Connection
{
    public function loginUser($username, $password)
    {
        // Escapes special characters in a string
        $username = mysqli_real_escape_string($this->conn, $username);
        $username = mysqli_real_escape_string($this->conn, $password);

        // Prepare and bind the SQL statement
        $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);

        // Execute the SQL statement
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {

            // Bind the result to variables
            $stmt->bind_result($id, $hashed_password);

            // Fetch the result
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Set the session variables
                $_SESSION['loggedin'] = true; $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;

                // Redirect to the user's welcome
                header("Location: welcome.php");
                exit;
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }

        // Close the connection
        $stmt->close();
        $this->conn->close();
    }

    public function registerUser($username, $password)
    {
        // Prepare and bind the SQL statement
        $sql = "INSERT into users (username, password)
            VALUES ('$username', '".md5($password)."')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        // Execute the SQL statement
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {

            // Bind the result to variables
            $stmt->bind_result($id, $hashed_password);

            // Fetch the result
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Set the session variables
                $_SESSION['loggedin'] = true; $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;

                // Redirect to the user's welcome
                header("Location: welcome.php");
                exit;
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }

        // Close the connection
        $stmt->close();
        $this->conn->close();
    }
}
