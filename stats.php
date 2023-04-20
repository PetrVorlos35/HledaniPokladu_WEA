<?php
    session_start();
    $connect = new mysqli("localhost", "root","","poklad_wea") or die();

    $email = $_SESSION["email"];
    $get_id = "SELECT * FROM users WHERE email = '$email'";
    $result = $connect->query($get_id);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["id"];
    $game_size = $_POST["velikostPole"];
    $moves_count = $_POST["pokusy"];
    $id = $connect->query("SELECT MAX(id) FROM stats")->fetch_row()[0] + 1;

    $sql = "INSERT INTO stats VALUES ('$id', '$user_id', '$game_size', '$moves_count')";
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