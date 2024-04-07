<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Assets/Common.css">
    <title>Login System</title>
</head>
<body>
    <h1>Login</h1>
    <form action="/login" method="post">
        <label for="username">Username:</label>
        <input id="username" name="username" required="" type="text" />
        <br><br>
        <label for="password">Password:</label> <input id="password" name="password" required="" type="password" />
        <br><br>
        <input name="login" type="submit" value="Login" />
        <p>
            <?php
                if (isset($_SESSION['result'])) {
                    echo $_SESSION['result']['message'];
                    unset($_SESSION['result']);
                }
            ?>
        </p>
    </form>
</body>
</html>
