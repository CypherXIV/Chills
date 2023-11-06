<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_uni_db";


$conn = new mysqli($host, $dbUser, $dbPass, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $username;
            $id = $_SESSION['id'];
            $roleQ = "SELECT role FROM users WHERE id = $id";
            $result = $conn->query($roleQ);
            while($row = $result->fetch_assoc()) {
                if ($row['role'] == 'customer'){
                    header("location: welcome.php");
                } else {
                    header("location: welcome-admin.php");
                }
            }
            exit;
        } else {
            $errorMsg = "Incorrect password!";
        }
    } else {
        $errorMsg = "Username not found!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="login-container">
        <h2>Login</h2>


        <?php if (!empty($errorMsg)) : ?>
            <p style="color: red;"><?php echo $errorMsg; ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username/Email:</label>
                <input type="text" name="username" id="username" required value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Login</button>

            <p><a href="register.php">Register</a></p>
        </form>
    </div>

</body>

</html>