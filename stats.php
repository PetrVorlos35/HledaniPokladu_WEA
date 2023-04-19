<?php
    $connect = new mysqli("localhost", "root","","poklad_wea") or die();

    $email = $_SESSION["email"];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connect->query($sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["id"];
    $game_size = $_POST["velikostPole"];
    $moves_count = $_POST["pokusy"];

    $sql = "INSERT INTO stats (user_id, game_size, moves_count) VALUES ('$user_id', '$game_size', '$moves_count')";
    if ($result = $connect->query($sql)) {
        echo "Stats saved!";
    }else {
        echo "error!";
    }

    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
</head>
<body>
    
</body>
</html>