<?php
    session_start();
    if($_SESSION['playerScore'] >= $_SESSION['cpuScore']){
        $winner = 0;
    }
    else{
        $winner = 1;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Feud</title>
    <link rel="stylesheet" href="./css/game-styles.css">
</head>
<body>
    <?php
        if($_SESSION['fastMoney'] == false){
            echo("
            <div class=\"game-area\">
            <h1>Your Score: " . htmlspecialchars($_SESSION['playerScore']) .  "</h1>
            <h1>CPU Score: " . htmlspecialchars($_SESSION['cpuScore']) .  "</h1>");

            if($winner == 0){
                echo("<a href=\"fast-money.php\"><button id=\"fast-money\">Go to Fast Money Round</button></a></div>");
            }
            else{
                echo("<a href=\"login.php\"><button id=\"login\">Log In to Save Score</button></a></div>");
            }
            

        } 
        else{
            echo("<div class=\"game-area\"><h1>Score: " . htmlspecialchars($_SESSION['playerScore']) .  "</h1><a href=\"login.php\"><button id=\"login\">Log In to Save Score</button></a></div>");
        }

    ?>

    
</body>
</html>