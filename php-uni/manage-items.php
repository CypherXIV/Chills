<?php
session_start();

$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_uni_db";


$conn = new mysqli($host, $dbUser, $dbPass, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$id = $_SESSION['id'];
$roleQ = "SELECT role FROM users WHERE id = $id";
$result = $conn->query($roleQ);
while($row = $result->fetch_assoc()) {
    if ($row['role'] == 'customer'){
        header("location: welcome.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Item Manager</h2>
        <p><a href="welcome-admin.php">Back to Dashboard</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>

</html>