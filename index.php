<?php
    include "common.php";

    session_start();

    if(isset($_SESSION['playerScore'])){
        newGame();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Feud</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div id="oval">
        <div id="logo-container">
            <img id="logo" src="./images/logo.png" alt="Family Feud Logo">
        </div>
        <div id="button-row">
            <a href="round1.php"><button id="play-button"><img src="./images/play.png" alt="Play Button"></button></a>
            <a href="leaderboard.php"><button id="leaderboard-button"><img src="./images/leaderboard.webp" alt="Leaderboard Button"></button></a>
        </div>
    </div>
</body>
</html>
