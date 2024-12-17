<?php
$conn = mysqli_connect("localhost", "root", "", "inventory_db");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize ID

    $stmt = mysqli_prepare($conn, "DELETE FROM items WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: inventory.php?status=deleted");
    exit();
} else {
    echo "Error: No item ID provided.";
}
mysqli_close($conn);
?>
