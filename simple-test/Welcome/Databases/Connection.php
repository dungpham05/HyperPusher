<?php

namespace Databases;

use Configs\DotEnv;

class Connection
{
    // Define variables for database connection
    private $serverName;
    private $userName;
    private $password;
    private $database;

    public function __construct() {
        (new DotEnv(__DIR__ . '/.env'))->load();
        $this->serverName = getenv('DATABASE_SERVER');
        $this->userName = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');
        $this->database = getenv('my_database');
    }

    public function connectToDatabase() {
        // Create connection
        $conn = mysqli_connect(
            $this->serverName,
            $this->userName,
            $this->password,
            $this->database
        );

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $conn;
    }

    public function closeConn($conn)
    {
        $conn->close();
    }
}
