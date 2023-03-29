<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login!">
    </form>

    <form action="index.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <label for="password2">Password again:</label>
        <input type="password" name="password2" id="password2">
        <input type="submit" value="Register!">
    </form>
</body>
</html>