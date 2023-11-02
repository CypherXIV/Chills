<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Welcome to the Dashboard,
            <?php
            if (isset($_SESSION["username"])) {
                echo htmlspecialchars($_SESSION["username"]);
            } else {
                echo "Guest";
            }
            ?>!
        </h2>
        <p>You've successfully logged in.</p>
        <p><a href="menu.php">Proceed to Menu</a></p>
        <p><a href="login.php">Logout</a></p>
    </div>
</body>

</html>