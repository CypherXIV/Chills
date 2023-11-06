<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_uni_db";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $secondaryPhone = $_POST["secondaryPhone"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $image = $_POST["image"];
    $role = "customer";

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "Username already exists!";
    } else {
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO users (username, password, name, phone, secondaryPhone, address, email, image, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $username, $password, $name, $phone, $secondaryPhone, $address, $email, $image, $role);
        $stmt->execute();

        $message = "Account created successfully!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="login-container">
        <p><a href="login.php">Back to Login</a></p>
        <h2>Create an Account</h2>
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br><br>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required><br><br>
            </div>

            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required><br><br>
            </div>

            <div class="input-group">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" required><br><br>
            </div>

            <div class="input-group">
                <label for="secondaryPhone">Secondary Phone Number:</label>
                <input type="text" name="secondaryPhone"><br><br>
            </div>

            <div class="input-group">
                <label for="address">Address:</label>
                <input type="text" name="address" required><br><br>
            </div>

            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" required><br><br>
            </div>

            <div class="input-group">
                <label for="image">Profile Picture:</label>
                <input type="file" name="image"><br><br>
            </div>

            <input type="submit" value="Register">
        </form>
    </div>

</body>

</html>