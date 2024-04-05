<!DOCTYPE html>
<html>
<head>
    <title>Login and Registration System</title>
</head>
<body>
    <h1>Login</h1>
    <form action="/Welcome/login" method="post">
        <label for="username">Username:</label>
        <input id="username" name="username" required="" type="text" />
        <br><br>
        <label for="password">Password:</label> <input id="password" name="password" required="" type="password" />
        <br><br>
        <input name="login" type="submit" value="Login" />
    </form>
</body>
</html>
