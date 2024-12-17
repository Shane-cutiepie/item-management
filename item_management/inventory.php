<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "inventory_db");

// Add new item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_item'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $query = "INSERT INTO items (name, price, quantity) VALUES ('$name', '$price', '$quantity')";
    mysqli_query($conn, $query);
    header("Location: inventory.php"); // Reload
    exit();
}

// Fetch all items
$result = mysqli_query($conn, "SELECT * FROM items");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        /* Form Styling */
        form {
            width: 90%;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #218838;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table a {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }
        table a:hover {
            text-decoration: underline;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Form to add new item -->
    <h2>Add New Item</h2>
    <form method="POST" action="">
        <label for="name">Item Name:</label>
        <input type="text" name="name" required>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        <button type="submit" name="add_item">Add Item</button>
    </form>

    <!-- Table to show items -->
    <h2>Items List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>
                    <a class="btn" href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                    |
                    <a class="btn" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
