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
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color: rgb(40, 44, 52); color:white">
    <label for="sirka">Šířka:</label>
    <input type="number" name="sirka" id="sirka" min="4" max="20" value="10">
    <label for="vyska">Výška:</label>
    <input type="number" name="vyska" id="vyska" min="4" max="20" value="10">
    <button id="createPool" onclick="vytvorPole()">Create pool</button>
    
    <div class="gamePool">

    </div>
    <form action="login.php">
        <button id="login">Login</button>
    </form>

    <script>
        let gamePool = $(".gamePool");

        
        function vytvorPole() {
            
            var sirka = $("#sirka").val();
            var vyska = $("#vyska").val();
            let id = 1;
            for (let i = 0; i < vyska; i++) {
                for (let j = 0; j < sirka; j++) {
                    gamePool.append("<button id='button-" + id + "' class='box' onclick='checkBox()'>X</button>");
                    id++;
                }
                gamePool.append("<br>");
            }
        $("#createPool").remove();
        }


        function checkBox() {
            $(this).css("background-color", "red");
        }
    </script>
</body>
</html>