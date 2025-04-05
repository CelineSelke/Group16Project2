<?php
// Set the path to your CSV file
$file = 'leaderboard.csv';

// Open the CSV file
if (($handle = fopen($file, 'r')) !== false) {
    // Initialize a counter to keep track of the number of rows processed
    $counter = 0;

    // Start the grid container
    echo "<div class='grid-container'>";

    // Read through the CSV file line by line
    while (($data = fgetcsv($handle)) !== false && $counter < 5) {
        // Output each row inside a div
        echo "<div class='grid-item'>";
        echo "<div class='field'>" . htmlspecialchars($data[0]) . "</div>"; // Column 1
        echo "<div class='field'>" . htmlspecialchars($data[1]) . "</div>"; // Column 2
        echo "</div>"; // End grid-item
        $counter++;
    }

    // Close the grid container
    echo "</div>";
    fclose($handle);
} else {
    echo "Error: Unable to open CSV file.";
}
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

</body>
</html>
