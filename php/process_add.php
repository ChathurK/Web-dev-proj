<?php
// Include database connection
include 'db_connect.php';

// Start the session to use CSRF token
session_start();

// Generate CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    // Sanitize and validate input data
    $item_name = htmlspecialchars(trim($_POST['item_name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $category = ($_POST['category']);

    if ($quantity === false) {
        die("Invalid quantity.");
    }

    if ($price === false) {
        die("Invalid price.");
    }

    // Prepare the SQL statement to insert the new item
    $sql = "INSERT INTO item (name, category, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL query
    $stmt->bind_param("ssid", $item_name, $category, $quantity, $price);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the inventory page after successful insertion
        header("Location: inventory.php");
        exit();
    } else {
        echo "<p>Error adding item: " . htmlspecialchars($stmt->error) . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
