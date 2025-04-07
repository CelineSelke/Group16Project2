<?php
    session_start(); // Start a session to preserve variables across requests

    include "common.php";

    if(!isset($_SESSION['playerScore'])){
        newGame();
    }
    else if($_SESSION['strikes'] > 2 && $_SESSION['round'] < 3){
        newRound();
    }

    // Check if the form is submitted and call revealAnswers function
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answerInput'])) {
        revealAnswers($_POST['answerInput']);
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
    <div class="player">
        <img src="./images/clipart-guy.png">
        <p>You</p>
        <p>Score: <?php echo $_SESSION['playerScore']; ?></p>
    </div>
    <div class="game-area">
        <h1>Family Feud</h1>
        <h2>Round: <?php echo $_SESSION['round']; ?></h2>
        <h3>Strikes: <?php echo $_SESSION['strikes']; ?></h3>
        <!-- Display the question -->
        <div id="question">
            <h2><?php echo htmlspecialchars($_SESSION['QandA']['question']); ?></h2>
        </div>

        <!-- Form for typing answers -->
        <form method="POST">
            <label for="answerInput">Type an answer:</label>
            <input type="text" name="answerInput" id="answerInput" placeholder="Type an answer to reveal">
            <button type="submit">Submit</button>
        </form>

        <!-- Grid for answers -->
        <div class="answers-grid">
            <div class="row">
                <?php 
                    // Access session variables
                    $visibleAnswers = $_SESSION['visibleAnswers'];
                    $QandA = $_SESSION['QandA'];

                    if ($visibleAnswers['answer1']) {
                        echo '<div class="answer">' . htmlspecialchars($QandA['answer1']) . ' ' . htmlspecialchars($QandA['answer1points']) . '</div>';
                    }
                    if ($visibleAnswers['answer2']) {
                        echo '<div class="answer">' . htmlspecialchars($QandA['answer2']) . ' ' . htmlspecialchars($QandA['answer2points']) . '</div>';
                    }
                ?>
            </div>
            <div class="row">
                <?php 
                    if ($visibleAnswers['answer3']) {
                        echo '<div class="answer">' . htmlspecialchars($QandA['answer3']) . ' ' . htmlspecialchars($QandA['answer3points']) . '</div>';
                    }
                    if ($visibleAnswers['answer4']) {
                        echo '<div class="answer">' . htmlspecialchars($QandA['answer4']) . ' ' . htmlspecialchars($QandA['answer4points']) . '</div>';
                    }
                ?>
            </div>
        </div>

    </div>
    <div class="player">
        <img src="./images/freddy.webp">
        <p>CPU</p>
        <p>Score: <?php echo $_SESSION['cpuScore']; ?></p>
    </div>
</body>
</html>
