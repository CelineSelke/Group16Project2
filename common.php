<?php

function newGame(){
    $_SESSION['playerScore'] = 0;

    $_SESSION['strikes'] = 0;

    $_SESSION['cpuScore'] = 0;

    $_SESSION['round'] = 1;

    $_SESSION['visibleAnswers'] = array('answer1' => false, 'answer2' => false, 'answer3' => false, 'answer4' => false);

    $_SESSION['QandA'] = get4Answers(); // Get the question and answers
}

function newRound(){
    $_SESSION['strikes'] = 0;

    $_SESSION['round'] += 1;

    $_SESSION['visibleAnswers'] = array('answer1' => false, 'answer2' => false, 'answer3' => false, 'answer4' => false);

    $_SESSION['QandA'] = get4Answers(); 
}

function get4Answers(){
    $csvFile = './questions/questions_4_answers.csv';

    // Check if the file exists
    if (!file_exists($csvFile)) {
        exit('File not found.');
    }

    $file = fopen($csvFile, 'r');

    // Read the entire file into an array of rows
    $rows = [];
    while (($row = fgetcsv($file)) !== false) {
        $rows[] = $row;
    }

    fclose($file);

    // Check if there are any rows in the CSV
    if (empty($rows)) {
        die('CSV file is empty.');
    }

    // select a row at random
    $randomRow = $rows[array_rand($rows)];

    // Assign values to the array with the required keys
    $quizData = [
        'question'        => $randomRow[0],    
        'answer1'         => $randomRow[1],    
        'answer1points'   => $randomRow[2],   
        'answer2'         => $randomRow[3],    
        'answer2points'   => $randomRow[4],    
        'answer3'         => $randomRow[5],   
        'answer3points'   => $randomRow[6],    
        'answer4'         => $randomRow[7],    
        'answer4points'   => $randomRow[8],   
    ];

    return $quizData;

}

    // Function to reveal answers based on user input
function revealAnswers($userInput) {
        // Access session variables
        $QandA = $_SESSION['QandA'];
        $visibleAnswers = &$_SESSION['visibleAnswers']; // Use reference to modify session value


        // Compare the user input with each answer (case-insensitive)
        foreach ($QandA as $key => $answer) {
            if (stripos($answer, $userInput) !== false && $visibleAnswers[$key] !== true) {
                $visibleAnswers[$key] = true;  // Mark the answer as visible if it matches
                if($key == "answer1"){
                    $_SESSION['playerScore'] += (int)$QandA['answer1points'];
                }
                if($key == "answer2"){
                    $_SESSION['playerScore'] +=  (int)$QandA['answer2points'];
                }
                if($key == "answer3"){
                    $_SESSION['playerScore'] +=  (int)$QandA['answer3points'];
                }
                if($key == "answer4"){
                    $_SESSION['playerScore'] +=  (int)$QandA['answer4points'];
                }
                return; // Stop after revealing the first matching answer
            }
        }
        //increment strike count if answer doesn't match and end round if strike count reaches three 
        $_SESSION['strikes'] += 1;
        if($_SESSION['strikes'] > 2){
            endRound();
        }
}

function endRound(){
    header('Location: round-results.php');
}


?>