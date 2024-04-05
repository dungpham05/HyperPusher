<?php

namespace Controllers;

use Databases\Connection;

class RegisterController
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Connection())->connectToDatabase();

        (new Connection())->closeConn($this->conn);
        die;
    }

    public function login() {
        session_start();

        if (isset($_POST['login'])) {
            // Prepare and bind the SQL statement
            $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
    
            // Get the form data
            $username = $_POST['username']; $password = $_POST['password'];
    
            // Execute the SQL statement
            $stmt->execute(); $stmt->store_result();
    
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
}
