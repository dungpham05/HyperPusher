<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome 
        <?php
            if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
                unset($_SESSION['result']);
            }
        ?>
    </h1>
</body>
</html>
