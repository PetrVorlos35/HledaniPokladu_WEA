<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "poklad_wea");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        $email = $_SESSION["email"];
        $best_moves = $connect->query("SELECT MIN(stats.moves_count) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'");
        $worst_moves = $connect->query("SELECT Max(stats.moves_count) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'");
        $avg_moves = $connect->query("SELECT ROUND(AVG(stats.moves_count), 1) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'");

        echo "<p>Best moves: " . $best_moves->fetch_row()[0] . "</p>";
        echo "<p>Worst moves: " . $worst_moves->fetch_row()[0] . "</p>";
        echo "<p>Average moves: " . $avg_moves->fetch_row()[0] . "</p>";

        mysqli_close($connect);
    ?>
    <form action="index.php">
        <button>Back</button>
    </form>
</body>
</html>