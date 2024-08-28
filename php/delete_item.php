<?php
// Include database connection
include 'db_connect.php';

// Get the item ID from the URL
$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($item_id > 0) {
    // Prepare the SQL delete statement
    $sql = "DELETE FROM item WHERE id = $item_id";

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        // Redirect to inventory.php after deletion
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid item ID.";
}

// Close the database connection
$conn->close();
?>
