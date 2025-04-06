<?php
    session_start(); // Start a session to preserve variables across requests

    include "common.php";

    // Initialize the visibleAnswers array if it doesn't exist in the session
    if(!isset($_SESSION['playerScore'])){
        $_SESSION['playerScore'] = 0;
    }


    if (!isset($_SESSION['visibleAnswers'])) {
        $_SESSION['visibleAnswers'] = array('answer1' => false, 'answer2' => false, 'answer3' => false, 'answer4' => false);
    }

    // Get the question and answers only once when the page is first loaded
    if (!isset($_SESSION['QandA'])) {
        $_SESSION['QandA'] = get4Answers(); // Get the question and answers
    }

    // Check if the form is submitted and call revealAnswers function
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answerInput'])) {
        revealAnswers($_POST['answerInput']);
    }

    // Function to reveal answers based on user input
    function revealAnswers($userInput) {
        // Access session variables
        $QandA = $_SESSION['QandA'];
        $visibleAnswers = &$_SESSION['visibleAnswers']; // Use reference to modify session value

        $userInput = strtolower(trim($userInput));  // Get and sanitize user input

        // Compare the user input with each answer (case-insensitive)
        foreach ($QandA as $key => $answer) {
            if (stripos($answer, $userInput) !== false) {
                $visibleAnswers[$key] = true;  // Mark the answer as visible if it matches
                break; // Stop after revealing the first matching answer
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
    <h1>Family Feud</h1>
    <h2>Score: <?php echo $_SESSION['playerScore']; ?></h2>
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
                echo '<div class="answer">' . htmlspecialchars($QandA['answer1']) . '</div>';
            }
            if ($visibleAnswers['answer2']) {
                echo '<div class="answer">' . htmlspecialchars($QandA['answer2']) . '</div>';
            }
            if ($visibleAnswers['answer3']) {
                echo '<div class="answer">' . htmlspecialchars($QandA['answer3']) . '</div>';
            }
            if ($visibleAnswers['answer4']) {
                echo '<div class="answer">' . htmlspecialchars($QandA['answer4']) . '</div>';
            }
        ?>
    </div>
</body>
</html>
