<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

$itemsOrdered = [];
$totalAmount = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'quantity-') === 0 && is_numeric($value) && $value > 0) {
            $itemId = str_replace('quantity-', '', $key);
            
            $stmt = $conn->prepare("SELECT name, price FROM menu WHERE id = ?");
            $stmt->bind_param("i", $itemId);
            $stmt->execute();

            $result = $stmt->get_result();
            $item = $result->fetch_assoc();

            $itemTotal = $item['price'] * $value;
            $totalAmount += $itemTotal;

            $itemsOrdered[] = [
                'id' => $itemId,
                'name' => $item['name'],
                'quantity' => $value,
                'total' => $itemTotal
            ];

            $stmt->close();
        }
    }

    $stmt = $conn->prepare("INSERT INTO orders(user_id, total_price) VALUES (?, ?)");
    $stmt->bind_param("ii", $_SESSION["id"], $totalAmount);
    $stmt->execute();
    $order_id = $conn->insert_id;
    $stmt->close();

    foreach ($itemsOrdered as $item) {
        $stmt = $conn->prepare("INSERT INTO order_details(order_id, item_id, quantity, total_price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['total']);
        $stmt->execute();
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="menu-container">
        <h2>Order Summary for <?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
        <table>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php foreach ($itemsOrdered as $item) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['total'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="2">Grand Total</th>
                <th>$<?php echo number_format($totalAmount, 2); ?></th>
            </tr>
        </table>
        <p><a href="menu.php">Back to Menu</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>

</html>

<?php 
$conn->close(); 
?>

