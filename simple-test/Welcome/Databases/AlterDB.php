<?php

namespace Databases;

use Databases\Connection;

class AlterDB extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createDatabaseIfNotExist() {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL auto_increment,
            `username` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        )";

        $this->conn->query($sql);

        if ($this->conn->query($sql) === TRUE) {
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}

(new AlterDB())->createDatabaseIfNotExist();
