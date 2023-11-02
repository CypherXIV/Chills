<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_uni_db";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$targetDir = "uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $targetFile = $targetDir . basename($_FILES["itemImage"]["name"]);
    move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFile);

    $stmt = $conn->prepare("INSERT INTO menu (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $targetFile);

    if ($stmt->execute()) {
        $msg = "Item added successfully!";
    } else {
        $msg = "Error adding item!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="login-container">
        <h2>Add New Item</h2>
        <form action="add-item.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Item Name:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="input-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required></textarea>
            </div>

            <div class="input-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" id="price" required>
            </div>

            <div class="input-group">
                <label for="itemImage">Item Image:</label>
                <input type="file" name="itemImage" id="itemImage" required>
            </div>

            <button type="submit">Add Item</button>
        </form>
    </div>
</body>

</html>