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
        if(isset($_SESSION["email"])){
            $email = $_SESSION["email"];
            echo "<p>User: " . $email . "</p>";
    ?>
    <table>
        <tr>
            <th colspan="2" style="text-align: center;">Stats</th>
        </tr>
        <tr>
    <?php
            $get_id = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connect, $get_id);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["id"];
            $sql = "SELECT * FROM stats WHERE user_id = '$user_id'";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<th>Game size</th>";
                echo "<th>Moves count</th>";
                echo "</tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["game_size"] . "</td>";
                    echo "<td>" . $row["moves_count"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }

            
            $email = $_SESSION["email"];
            $best_moves = $connect->query("SELECT MIN(stats.moves_count) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'");
            $worst_moves = $connect->query("SELECT MAX(stats.moves_count) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'");
            $worst_moves_select = "SELECT MAX(stats.moves_count) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'";
            $avg_moves = $connect->query("SELECT ROUND(AVG(stats.moves_count), 1) FROM stats JOIN users ON stats.user_id = users.id WHERE users.email = '$email'");

?>
        <table>
        <tr>
            <th>Statistic</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Best moves</td>
            <td><?php echo $best_moves->fetch_row()[0]; ?></td>
        </tr>
        <tr>
            <td>Worst moves</td>
            <td><?php echo $worst_moves->fetch_row()[0]; ?></td>
        </tr>
        <tr>
            <td>Average moves</td>
            <td><?php echo $avg_moves->fetch_row()[0]; ?></td>
        </tr>
        </table>
<?php
        }
        else{
            echo "You are not logged in!";
        }
        mysqli_close($connect);
    ?>
    </table>
    <form action="index.php">
        <button>Back</button>
    </form>
</body>
</html>