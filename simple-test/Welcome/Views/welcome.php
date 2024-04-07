<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Assets/Common.css">
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
