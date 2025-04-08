<?php
$file = 'leaderboard.csv';


$data = []; // Stores all data from CSV
if (($handle = fopen($file, 'r')) !== false) {
    while (($row = fgetcsv($handle)) !== false) { // Read CSV line by line
        if (count($row) >= 2) { // Prevents error when reading less than two values
            $data[] = [$row[0], (int)$row[1]]; 
        }
    }
    fclose($handle);
}

// Sort scores by descending
usort($data, function($a, $b) {
    return $b[1] <=> $a[1];
});

// Keep top 5 and overwrite file
$topFive = array_slice($data, 0, 5);
if (($handle = fopen($file, 'w')) !== false) { // Open and clear file
    foreach ($topFive as $row) { //Adds all value back in the CSV
        fputcsv($handle, $row);
    }
    fclose($handle);
}

// Display the top 5
echo "<div class='grid-container'>";
$counter = 0;
foreach ($topFive as $row) {
    echo "<div class='grid-item'>";
    echo "<div class='field'>" . htmlspecialchars($row[0]) . "</div>";
    echo "<div class='field'>" . htmlspecialchars($row[1]) . "</div>";
    echo "</div>";
    $counter++;
}
echo "</div>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard Grid</title>
    <link rel="stylesheet" href="./css/leaderboard-styles.css">
</head>
<body>

<div id="button-row">
    <a href="./index.php"><button id="play-button"><img src="./images/play.png" alt="Play Button"></button></a>
</div>

</body>
</html>