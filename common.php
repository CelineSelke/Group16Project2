<?php
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


?>