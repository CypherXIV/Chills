<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "php_uni_db";
$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT id, name, description, price, image FROM menu");
$stmt->execute();
$result = $stmt->get_result();
$menu_items = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .menu-item {
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
        }

        .quantity-controls input {
            width: 40px;
            text-align: center;
            margin: 0 10px;
        }

        .menu-controls {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <form method="post" action="checkout.php">
        <div class="menu-container">
            <?php foreach ($menu_items as $item) : ?>
                <div class="menu-item">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
                    <div class="quantity">
                        <button type="button" onclick="decrementItem('<?php echo $item['id']; ?>')">-</button>
                        <input type="text" id="quantity-<?php echo $item['id']; ?>" name="quantity-<?php echo $item['id']; ?>" value="0">
                        <button type="button" onclick="incrementItem('<?php echo $item['id']; ?>')">+</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="menu-controls">
            <button type="submit">Confirm Order</button>
            <a href="welcome.php">Back to Dashboard</a>
        </div>
    </form>

    <script>
        function decrementItem(itemId) {
            const inputElem = document.getElementById('quantity-' + itemId);
            let currentValue = parseInt(inputElem.value, 10);
            if (currentValue > 0) {
                inputElem.value = currentValue - 1;
            }
        }

        function incrementItem(itemId) {
            const inputElem = document.getElementById('quantity-' + itemId);
            let currentValue = parseInt(inputElem.value, 10);
            inputElem.value = currentValue + 1;
        }
    </script>

</body>

</html>