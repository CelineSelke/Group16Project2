<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $score = $_POST['score'] ?? 0;

    $_SESSION['username'] = $username;

    // Save to CSV
    $row = [$username, $score];
    file_put_contents('leaderboard.csv', implode(',', $row) . "\n", FILE_APPEND);

    header('Location: leaderboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter your name" required>

        <input type="hidden" name="score" value="<?php echo $_GET['score'] ?? $_POST['score'] ?? 0; ?>">

        <button type="submit">Save to Leaderboard</button>
    </form>
</body>
</html>
