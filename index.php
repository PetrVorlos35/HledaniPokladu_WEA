<?php
    session_start();
    if (isset($_SESSION["isLogged"])) {
        $isLogged = $_SESSION["isLogged"];
    }else {
        $isLogged = false;
    }
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        if($isLogged){
            echo "Uživatel " . $_SESSION["email"] . " je přihlášen <br>";
        }
    ?>
    <p id="attempts"></p>
    <label for="sirka">Šířka:</label>
    <input type="number" name="sirka" id="sirka" min="4" max="20" value="10">
    <label for="vyska">Výška:</label>
    <input type="number" name="vyska" id="vyska" min="4" max="20" value="10">
    <button id="createPool" onclick="vytvorPole()">Create pool</button>
    
    <form action="login.php">
        <button id="login">Login</button>
    </form>
    <div class="container">
        <div class="gamePool">

        </div>
    </div>
    <div id="borderOfGamepool"></div>
    <script>
        let gamePool = $(".gamePool");
        let id = 1;
        let pokusy = 0;

        let attempts = $("#attempts");

        function vytvorPole() {
            attempts.text("Attempts: " + pokusy);
            var sirka = $("#sirka").val();
            var vyska = $("#vyska").val();
            let velikostPole = sirka + "x" + vyska;
            console.log(velikostPole);
            gamePool.empty();
            for (let i = 0; i < vyska; i++) {
                for (let j = 0; j < sirka; j++) {
                    gamePool.append("<button id='button-" + id + "' class='box' onclick='checkBox.call(this)'><div class='texInButton'></div></button>");
                    id++;
                }
                gamePool.append("<br>");
            }
            rndNumber = rnd(1, id);
            let poklad = $("#button-" + rndNumber);
            poklad.css("outline", "2px solid white").css("outline-offset", "-2px");
            poklad.prop("id", "poklad");

            $("#createPool").prop('disabled', true);
            gamePool.show();
        }

        

        function checkBox() {
            if(this.id == "poklad") {
                alert("You found the treasure! You had " + pokusy + " attempts.");
                this.style.backgroundColor = "green";
                id = 1;
                $(this).children().text("W");
                // gamePool.hide();
                $("#createPool").prop('disabled', false);
                $(".box").prop('disabled', true);
                pokusy = 0;
                return;
            }
            else if(this.style.backgroundColor == "red"){
                alert("You already checked this box!");
                return;
            }
            else if(this.style.backgroundColor == "green"){
                alert("You already found the treasure!");
                return;
            }
            
            $(this).children().text("L");
            this.style.backgroundColor = "red";
            $("this").prop('disabled', true);
            pokusy++;
            attempts.text("Attempts: " + pokusy);
            console.log(pokusy);
        }

        function rnd(floor, ceiling) {
            return Math.floor(Math.random() * (ceiling - floor + 1)) + floor;
        }

    </script>
</body>
</html>
