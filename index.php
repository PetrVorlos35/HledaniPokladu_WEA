<?php
    session_start();
    if (isset($_SESSION["isLogged"])) {
        $isLogged = $_SESSION["isLogged"];
    }else {
        $isLogged = false;
    }

    $connect = new mysqli("localhost", "root","","poklad_wea") or die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hledání pokladu</title>
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="game.css">
</head>
<body>
    <?php
        if($isLogged){
            $email = $_SESSION["email"];
            echo "<h3>User: <span style='font-weight: normal'>" . $email . "</span></h3>";
        }
    ?>
    <h1>Hledání pokladu</h1>
    <div id="inputsForGame">
        <p id="attempts"></p>
        <label for="sirka">Šířka:</label>
        <input type="number" name="sirka" id="sirka" min="4" max="20" value="10">
        <label for="vyska">Výška:</label>
        <input type="number" name="vyska" id="vyska" min="4" max="20" value="10">
        <button id="createPool" onclick="vytvorPole()">Create pool</button> 
    </div>
    
    <form action="stats.php">
        <button class="loginRegister" id="stats">Stats</button>
    </form>

    <?php if ($isLogged): ?>
        <form action="logout.php">
            <button id="logout" class="loginRegister">Logout</button>
        </form>
    <?php else: ?>
        <form action="login.php">
            <button id="login" class="loginRegister">Login</button>
        </form>
    <?php endif; ?>

    
    <div class="container">
        <div class="gamePool">

        </div>
    </div>
    <script>
        let gamePool = $(".gamePool");
        let id = 1;
        let pokusy = 0;
        let velikostPole = "";
        let pokladX = 0;
        let pokladY = 0;

        let attempts = $("#attempts");

        function vytvorPole() {
            attempts.text("Attempts: " + pokusy);
            var sirka = $("#sirka").val();
            var vyska = $("#vyska").val();
            velikostPole = sirka + "x" + vyska;
            // console.log(velikostPole);
            gamePool.empty();
            for (let i = 0; i < vyska; i++) {
                for (let j = 0; j < sirka; j++) {
                    gamePool.append("<button id='button-" + id + "' class='box' x='" + i + "' y='" + j + "' onclick='checkBox.call(this);showPosition(this)'><div class='texInButton'></div></button>");
                    id++;
                }
                gamePool.append("<br>");
            }
            rndNumber = rnd(1, id);
            let poklad = $("#button-" + rndNumber);
            pokladX = poklad.attr("x");
            pokladY = poklad.attr("y");
            poklad.prop("id", "poklad");

            $("#createPool").prop('disabled', true);
            gamePool.show();
        }
        function showPosition(button) {
            let x = $(button).attr("x");
            let y = $(button).attr("y");

            if (x == pokladX && y == pokladY) {
                // alert("You found the treasure! You had " + pokusy + " attempts.");
                // saveStats();
                // gamePool.hide();
                // $("#createPool").prop('disabled', false);
            } else {
                if(y > pokladY && x > pokladX) {
                    $(button).children().text("SZ");
                } else if(y > pokladY && x < pokladX) {
                    $(button).children().text("JZ");
                } else if(y < pokladY && x > pokladX) {
                    $(button).children().text("SV");
                } else if(y < pokladY && x < pokladX) {
                    $(button).children().text("JV");
                } else if (x < pokladX) {
                    $(button).children().text("J");
                } else if (y > pokladY) {
                    $(button).children().text("Z");
                } else if (y < pokladY) {
                    $(button).children().text("V");
                }else if (x > pokladX) {
                    $(button).children().text("S");
                }
                // pokusy++;
                // attempts.text("Attempts: " + pokusy);
            }
        }

        // function saveStats(){
            
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('POST', 'index.php', true);
        //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //     var data = 'velikostPole=' + encodeURIComponent(velikostPole) + '&pokusy=' + encodeURIComponent(pokusy);
        //     xhr.send(data);

        //     <?php
        //         header("Cache-Control: no-cache, must-revalidate"); 

        //         if(isset($_POST['velikostPole']) && isset($_POST['pokusy'])){
        //             $velikostPole = $_POST['velikostPole'] ?? '';
        //             $pokusy = $_POST['pokusy'] ?? '';

        //             if($isLogged){
        //                 $sql = "INSERT INTO stats (user_id, game_size, moves_count) VALUES ( (SELECT id FROM users WHERE email = '" . $_SESSION["email"] . "'), '" . $velikostPole . "', '" . $pokusy . "' )";
        //                 if ($result = $connect->query($sql)) {
        //                     echo "Stats saved!";
        //                 }else {
        //                     echo "error!";
        //                 }
        //             }
        //         }

        //     ?>
        // }
        function checkBox() {
            $('#alreadyChecked').text("");
            if(this.id == "poklad") {
                // alert("You found the treasure! You had " + pokusy + " attempts.");
                this.style.backgroundColor = "green";
                id = 1;
                // $(this).children().text("W");
                // gamePool.hide();
                $("#createPool").prop('disabled', false);
                $(".box").prop('disabled', true);
                pokusy++;
                attempts.text("Attempts: " + pokusy);
                saveStats();
                pokusy = 0;
                return;
            }
            else if(this.style.backgroundColor == "red"){
                $('#alreadyChecked').text("You already checked this field!");
                return;
            }
            
            // $(this).children().text("L");
            this.style.backgroundColor = "red";
            $("this").prop('disabled', true);
            pokusy++;
            attempts.text("Attempts: " + pokusy);
        }

        function saveStats(){
            $.ajax({
                type: "POST",
                url: "saveStats.php",
                data: {
                    velikostPole: velikostPole,
                    pokusy: pokusy
                },
                success: function(data){
                    console.log(data);
                }
            });
        }


        function rnd(floor, ceiling) {
            return Math.floor(Math.random() * (ceiling - floor + 1)) + floor;
        }

    </script>
    <span id="alreadyChecked" style="color:red"></span>
</body>
</html>
