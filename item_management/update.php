<?php
$conn = mysqli_connect("localhost", "root", "", "inventory_db");

// Fetch existing item data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM items WHERE id = $id");
    $item = mysqli_fetch_assoc($result);
}

// Handle the update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $query = "UPDATE items SET name = '$name', price = '$price', quantity = '$quantity' WHERE id = $id";
    mysqli_query($conn, $query);

    header("Location: inventory.php?status=updated");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Item</title>
</head>
<body>
    <h1>Update Item</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" value="<?php echo $item['price']; ?>" required>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" required>
        <button type="submit">Update Item</button>
    </form>
</body>
</html>
