<?php
    session_start();
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
    <h2>Score: <?php echo $_SESSION['playerScore']; ?></h2>
    <h2>Score: <?php echo $_SESSION['cpuScore']; ?></h2>

    <a href="round1.php"><button id="play-button"><img src="./images/play.png" alt="Play Button"></button></a>
</body>
</html>