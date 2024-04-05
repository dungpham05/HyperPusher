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
    protected $conn;

    public function __construct()
    {
        (new DotEnv(__DIR__ . '/../.env'))->load();
        $this->serverName = getenv('DATABASE_SERVER');
        $this->userName = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');
        $this->database = getenv('DATABASE_NAME');
        $this->connectToDatabase();
    }

    public function connectToDatabase()
    {
        // Create connection
        $this->conn = mysqli_connect(
            $this->serverName,
            $this->userName,
            $this->password,
            $this->database
        );

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $this->conn;
    }

    public function closeConn($conn)
    {
        $conn->close();
    }
}
