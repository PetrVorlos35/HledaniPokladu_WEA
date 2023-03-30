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

    <script>
        let gamePool = $(".gamePool");
        let id = 1;

        function vytvorPole() {
            var sirka = $("#sirka").val();
            var vyska = $("#vyska").val();
            gamePool.empty();
            for (let i = 0; i < vyska; i++) {
                for (let j = 0; j < sirka; j++) {
                    gamePool.append("<button id='button-" + id + "' class='box' onclick='checkBox.call(this)'></button>");
                    id++;
                }
                gamePool.append("<br>");
            }
            $("#createPool").prop('disabled', true);
            gamePool.show();
        }

        function checkBox() {
            this.style.backgroundColor = "red";
        }
    </script>
</body>
</html>
