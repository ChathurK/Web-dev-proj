<?php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION["id"]) || $_SESSION["id"] !== "logg") {
    header('Location: login.php');
    exit();
}

// Include the database connection
include 'db_connect.php';

// Get the category from the URL
$category = isset($_GET['category']) ? $_GET['category'] : '';

$category = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');

// Query to get inventory items based on the selected category
$sql = "SELECT id, name, category, quantity, price, added_date FROM item WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - <?php echo ucfirst($category); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex align-items-center">
            <a href="dd.php" class="btn btn-light">Dashboard</a>
            <h1 class="m-0 flex-grow-1 text-center">Inventory Management</h1>
        </div>
    </header>

    <div class="container mt-5">
        <h2><?php echo ucfirst($category); ?> Inventory</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Added Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are records in the database
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['category']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['added_date']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No items found in this category.</td></tr>";
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>