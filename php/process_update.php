<?php
// Include database connection
include 'db_connect.php';

session_start();

// Generate CSRF token if it doesn't exist
// if (empty($_SESSION['csrf_token'])) {
//     $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
// }

// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Validate CSRF token
//     if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
//         die("Invalid CSRF token");
//     }

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $item_id = intval($_POST['id']);
    $item_name = htmlspecialchars(trim($_POST['item_name']));
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $category = $_POST['category'];

    // Prepare SQL statement to update the item
    $sql = "UPDATE item SET name = ?, quantity = ?, price = ?, category = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL query
    $stmt->bind_param("sidsi", $item_name, $quantity, $price, $category, $item_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to inventory page and refresh
        header("Location: inventory.php");
        exit();
    } else {
        error_log("Error updating item: " . $stmt->error);
        echo "<p>There was an error updating the item. Please try again later.</p>";
    }    

    // Close the statement
    $stmt->close();
}


// Close the connection
$conn->close();
?>