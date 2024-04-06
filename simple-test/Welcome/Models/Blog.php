<?php

namespace Models;

use Databases\Connection;

Class Blog extends Connection
{
    public function getAllBlog()
    {
        $result = [];

        // Prepare and bind the SQL statement
        $sql = "SELECT * FROM blogs";
        $stmt = $this->conn->query($sql);

        while ($row = $stmt->fetch_assoc()) {
            $result[] = $row;
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function getDetailBlogById($id)
    {
        $result = [];

        // Prepare and bind the SQL statement
        $sql = "SELECT * FROM blogs WHERE id = $id";
        $stmt = $this->conn->query($sql);

        while ($row = $stmt->fetch_assoc()) {
            $result = $row;
        }

        // Close the connection
        $stmt->close();

        return $result;
    }

    public function createBlogByContents($contentVn, $contentEn)
    {
        $result = [];

        $contentVn = mysqli_real_escape_string($this->conn, $contentVn);
        $contentEn = mysqli_real_escape_string($this->conn, $contentEn);

        // Prepare and bind the SQL statement
        $sql = "INSERT into blogs (content_vn, content_en) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the result to variables
        $stmt->bind_param("ss", $contentVn, $contentEn);

        // Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "New blog created successfully",
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

    public function editBlogById($id)
    {
        $result = [];

        $contentVn = mysqli_real_escape_string($this->conn, $_POST['content-vn']);
        $contentEn = mysqli_real_escape_string($this->conn, $_POST['content-en']);
        $id = mysqli_real_escape_string($this->conn, $id);

        // Prepare and bind the SQL statement
        $sql = "UPDATE blogs SET `content_vn` = ?, `content_en` = ? WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $contentVn, $contentEn, $id);

        // Execute the SQL statement && Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "Edited blog successfully",
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

    public function deleteBlogById($id)
    {
        $result = [];

        $id = mysqli_real_escape_string($this->conn, $id);

        // Prepare and bind the SQL statement
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);

        // Execute the SQL statement && Check if the user exists
        if ($stmt->execute()) {
            $result = [
                "message" => "Deleted blog successfully",
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
