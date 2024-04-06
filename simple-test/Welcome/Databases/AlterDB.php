<?php

namespace Databases;

use Databases\Connection;

class AlterDB extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createTableUsersIfNotExist() {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL auto_increment,
            `username` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE (username)
        )";

        $this->conn->query($sql);

        if ($this->conn->query($sql) === TRUE) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function createTableBlogsIfNotExist() {
        $sql = "CREATE TABLE IF NOT EXISTS `blogs` (
            `id` int(11) NOT NULL auto_increment,
            `content_vn` varchar(255),
            `content_en` varchar(255),
            PRIMARY KEY (`id`)
        )";

        $this->conn->query($sql);

        if ($this->conn->query($sql) === TRUE) {
            echo "Table blogs created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function createTableTasksIfNotExist() {
        $sql = "CREATE TABLE IF NOT EXISTS `tasks` (
            `id` int(11) NOT NULL auto_increment,
            `user_name` varchar(255),
            `task_name` varchar(255),
            `start_time` TIMESTAMP,
            `expire_time` TIMESTAMP,
            PRIMARY KEY (`id`)
        )";

        $this->conn->query($sql);

        if ($this->conn->query($sql) === TRUE) {
            echo "Table tasks created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }
}

(new AlterDB())->createTableUsersIfNotExist();
(new AlterDB())->createTableBlogsIfNotExist();
(new AlterDB())->createTableTasksIfNotExist();
