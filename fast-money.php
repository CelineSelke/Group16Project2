<?php
    session_start();
    include "common.php";

    if(!isset($_SESSION['question_index'])){
        $_SESSION['visibleAnswers'] = array('answer1' => false, 'answer2' => false, 'answer3' => false, 'answer4' => false);
        $_SESSION['question_index'] = 0;
    }

    if(!isset($_SESSION['QAList'])){
        $QA1 = get4Answers();
        $QA2 = get4Answers();
        $QA3 = get4Answers();
        $QA4 = get4Answers();

        $_SESSION['QAList'] = [$QA1, $QA2, $QA3, $QA4];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach($_SESSION['QAList'] as $QandA){
            foreach ($QandA as $key => $answer) {
                if (stripos($answer, $userInput) !== false && $visibleAnswers[$key] !== true) {
                    $visibleAnswers[$key] = true;  // Mark the answer as visible if it matches
                    if($key == "answer1"){
                        $_SESSION['playerScore'] += (int)$QandA['answer1points'];
                        $_SESSION['question_index']++;

                    }
                    if($key == "answer2"){
                        $_SESSION['playerScore'] +=  (int)$QandA['answer2points'];
                        $_SESSION['question_index']++;

                    }
                    if($key == "answer3"){
                        $_SESSION['playerScore'] +=  (int)$QandA['answer3points'];
                        $_SESSION['question_index']++;

                    }
                    if($key == "answer4"){
                        $_SESSION['playerScore'] +=  (int)$QandA['answer4points'];
                        $_SESSION['question_index']++;

                    }


                    return; // Stop after revealing the first matching answer
                }
            }
        }
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
    <div class="board">
        <div class="player">
            <img src="./images/clipart-guy.png">
            <p>You</p>
            <p>Score: <?php echo $_SESSION['playerScore']; ?></p>
        </div>
        <div class="game-area">
            <!-- Display the question -->
            <div id="question">
                <h2><?php 
                
                $question =  $_SESSION['QAList'][$_SESSION['question_index']]['question'];

                echo(htmlspecialchars($question));
                
                ?></h2>
            </div> 

            <!-- Form for typing answers -->


            <!-- Grid for answers -->
            <div class="answers-grid">
                <?php 
                $visibleAnswers = $_SESSION['visibleAnswers'];
                $QandA = $_SESSION['QAList'][$_SESSION['question_index']];

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
    <footer>
        <form method="POST">
            <label for="answerInput">Type an answer:</label>
            <input type="text" name="answerInput" id="answerInput" placeholder="Type an answer to reveal">
            <input type="image" src="./images/arrow.svg" alt="Submit" width="50" height="50">
        </form>
    </footer>
</body>
</html>
