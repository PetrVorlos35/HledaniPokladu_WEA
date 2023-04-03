<?php
    $connect = new mysqli("localhost", "root","","poklad_wea") or die();

    // if($connect->connect_errno){
    //     echo "Nastala chyba neumíte pracovat s DB: ".$connect->connect_error;
    // }
    // else{
    //     echo "Připojili jste se úšpěšně k DB";
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 id="header">Login or register</h1>
    <div id="login">
        <form action="index.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Login!">
        </form>
    </div>

    <div id="register">
        <form action="index.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <label for="password2">Password again:</label>
            <input type="password" name="password2" id="password2">
            <input type="submit" value="Register!">
        </form>
    </div>
</body>
</html>