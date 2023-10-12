<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_uni_db";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    echo "Account created successfully!";
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <h2>Create an Account</h2>
    <form action="register.php" method="post">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>
        </div>
        
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
        </div>

        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>
