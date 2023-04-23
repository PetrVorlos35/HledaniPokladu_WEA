<?php
    $connect = new mysqli("localhost", "root","","poklad_wea") or die();

    // if($connect->connect_errno){
    //     echo "Nastala chyba neumíte pracovat s DB: ".$connect->connect_error;
    // }
    // else{
    //     echo "Připojili jste se úšpěšně k DB";
    // }

    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1 id="header">Login or register</h1>
    <div class="form">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Login!" name="login">
        </form>
    </div>

    <div class="form">
        <h2>Register</h2>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <label for="password2">Password again:</label>
            <input type="password" name="password2" id="password2" required>
            <input type="submit" value="Register!" name="register">
        </form>
    </div>

    <div id="noLogin">
        <form action="index.php">
            <button>Continue without logging in</button>
        </form>
    </div>

    <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_object();
                if(password_verify($password, $user->password)){
                    $_SESSION["isLogged"] = true;
                    $_SESSION["email"] = $email;
                    header("Location: index.php");
                    echo "Logged in!";
                }else{
                    echo "Wrong password!";
                }
            }else {
                echo "User not found!";
            }
        }

        if (isset($_POST["register"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $password2 = $_POST["password2"];

            if ($password == $password2) {
                $hashpassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashpassword')";
                // $result = $connect->query($sql);

                if ($result = $connect->query($sql)) {
                    echo "User registered!";
                }else {
                    echo "User not registered!";
                }
            }else {
                echo "Passwords are not the same!";
            }
        }
    ?>
</body>
</html>