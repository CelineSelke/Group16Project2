<?php
    include "common.php";

    // Get the question and answers
    $QandA = get4Answers();
    
    // Initialize an empty array to store answers that match user input
    $visibleAnswers = array('answer1' => false, 'answer2' => false, 'answer3' => false, 'answer4' => false);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answerInput'])) {
        $userInput = strtolower(trim($_POST['answerInput']));  // Get and sanitize user input

        // Compare the user input with each answer (case-insensitive)
        foreach ($QandA as $key => $answer) {
            if (stripos($answer, $userInput) !== false) {
                $visibleAnswers[$key] = true;  // Mark the answer as visible if it matches
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

    <!-- Display the question -->
    <div id="question">
        <h2><?php echo htmlspecialchars($QandA['question']); ?></h2>
    </div>

    <!-- Form for typing answers -->
    <form method="POST" action="">
        <label for="answerInput">Type an answer:</label>
        <input type="text" name="answerInput" id="answerInput" placeholder="Type an answer to reveal">
        <button type="submit">Submit</button>
    </form>

    <!-- Grid for answers -->
    <div class="answers-grid">
        <?php 
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
