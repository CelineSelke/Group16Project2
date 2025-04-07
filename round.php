<?php
    // session_start(); // Start a session to preserve variables across requests

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
    <header>
    <div id="question">
        <h2><?php echo htmlspecialchars($_SESSION['QandA']['question']); ?></h2>
    </div>
    </header>
    <div class="board-box" id="outer">
        <div class="board-box" id="inner">
            <div class="board">
                <div class="player">
                    <img src="./images/clipart-guy.png">
                    <p>You</p>
                    <p>Score: <?php echo $_SESSION['playerScore']; ?></p>
                </div>
                <div class="game-area">
                    <!-- Display the question -->
                    <h2>Round: <?php echo $_SESSION['round']; ?></h2>
                    <h3>Strikes: <?php echo $_SESSION['strikes']; ?></h3>
                    
                    

                    <!-- Form for typing answers -->


                    <!-- Grid for answers -->
                    <div class="answers-grid">
                        <?php 
                        // $visibleAnswers = $_SESSION['visibleAnswers'];
                        // $QandA = $_SESSION['QandA'];

                        for ($i = 1; $i <= 6; $i++) {
                            if (!empty($visibleAnswers["answer$i"])) {
                                echo '<div class="answer">' . htmlspecialchars($QandA["answer$i"]) . ' ' . htmlspecialchars($QandA["answer{$i}points"]) . '</div>';
                            } else {
                                echo '<div class="answer"></div>'; // keeps the grid consistent
                            }
                        }

                            echo '<div class="answer full-span"></div>';
                        ?>
                    </div>

                </div>
                <div class="player">
                    <img src="./images/freddy.webp">
                    <p>CPU</p>
                    <p>Score: <?php echo $_SESSION['cpuScore']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <form method="POST">
            <label for="answerInput">Type an answer:</label>
            <input type="text" name="answerInput" id="answerInput" placeholder="Type an answer to reveal">
            <input type="image" src="./images/arrow.svg" alt="Submit" width="50" height="50">
        </form>
    </footer>
</body>
</html>
