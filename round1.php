<?php
    session_start(); // Start a session to preserve variables across requests

    include "common.php";

    if(!isset($_SESSION['playerScore'])){
        newGame();
    }
    else if($_SESSION['strikes'] > 2){
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
    <div class="game-area">
        <h1>Family Feud</h1>
        <h2>Score: <?php echo $_SESSION['playerScore']; ?></h2>
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
            <?php 
                // Access session variables
                $visibleAnswers = $_SESSION['visibleAnswers'];
                $QandA = $_SESSION['QandA'];

                // Check if answers should be visible and display them
                if ($visibleAnswers['answer1']) {
                    echo '<div class="answer">' . htmlspecialchars($QandA['answer1']) . ' ' . htmlspecialchars($QandA['answer1points']) . '</div>';
                }
                if ($visibleAnswers['answer2']) {
                    echo '<div class="answer">' . htmlspecialchars($QandA['answer2']) . ' ' . htmlspecialchars($QandA['answer2points']) . '</div>';
                }
                if ($visibleAnswers['answer3']) {
                    echo '<div class="answer">' . htmlspecialchars($QandA['answer3']) . ' ' . htmlspecialchars($QandA['answer1points']) . '</div>';
                }
                if ($visibleAnswers['answer4']) {
                    echo '<div class="answer">' . htmlspecialchars($QandA['answer4']) . ' ' . htmlspecialchars($QandA['answer1points']) . '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
