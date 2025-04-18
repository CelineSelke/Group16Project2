<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function newGame(){
    $_SESSION['playerScore'] = 0;

    $_SESSION['fastMoney'] = false;

    $_SESSION['strikes'] = 0;

    $_SESSION['cpuScore'] = 0;

    $_SESSION['round'] = 1;

    $_SESSION['visibleAnswers'] = array('answer1' => false, 'answer2' => false, 'answer3' => false, 'answer4' => false);

    $_SESSION['QandA'] = get4Answers(); // Get the question and answers
    
    $_SESSION['answerList'] = ["","","","","",""];

    $_SESSION['question_index'] = -1;

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
            if (stripos($answer, $userInput) !== false && $visibleAnswers[$key] !== true && strlen($userInput) >= 1) {
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
                if (count(array_filter($visibleAnswers, fn($value) => $value === true)) === count($visibleAnswers)) {
                    $_SESSION['strikes'] = 3;
                    endRound();
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
    if($_SESSION['round']  < 3){
        header('Location: round-results.php');
    }
    else{
        header('Location: final-results.php');
    }
}

function updateCPUScore(){
    $QandA = $_SESSION['QandA'];
    for($i = 1; $i <= 4; $i++){
        $rng = rand(0,99);
        if($i == 1){
            if($rng > 25){
                $_SESSION['cpuScore'] += (int)$QandA['answer1points'];
            }
        }
        if($i == 2){
            if($rng > 50){
                $_SESSION['cpuScore'] += (int)$QandA['answer2points'];
            }
        }
        if($i == 3){
            if($rng > 60){
                $_SESSION['cpuScore'] += (int)$QandA['answer3points'];
            }
        }
        if($i == 4){
            if($rng > 70){
                $_SESSION['cpuScore'] += (int)$QandA['answer4points'];
            }
        }
    }
}


?>