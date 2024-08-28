<?php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include database connection
include 'db_connect.php';

// Initialize variables for totals
$total_items = 0;
$total_quantity = 0;
$total_value = 0;

// Query to get total number of distinct items
$sql_total_items = "SELECT COUNT(*) as total_items FROM item";
$result_total_items = $conn->query($sql_total_items);
if ($result_total_items->num_rows > 0) {
    $row = $result_total_items->fetch_assoc();
    $total_items = $row['total_items'];
}

// Query to get total quantity and total value of the inventory
$sql_totals = "SELECT SUM(quantity) as total_quantity, SUM(quantity * price) as total_value FROM item";
$result_totals = $conn->query($sql_totals);
if ($result_totals->num_rows > 0) {
    $row = $result_totals->fetch_assoc();
    $total_quantity = $row['total_quantity'];
    $total_value = $row['total_value'];
}

// Fetch all items for CSV export
$sql_items = "SELECT * FROM item";
$result_items = $conn->query($sql_items);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex align-items-center">
            <a href="dd.php" class="btn btn-light">Dashboard</a>
            <h1 class="m-0 flex-grow-1 text-center">Inventory Report</h1>
        </div>
    </header>

    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header">
                <h2>Summary</h2>
            </div>
            <div class="card-body">
                <p><strong>Total Items:</strong> <?php echo $total_items; ?></p>
                <p><strong>Total Quantity:</strong> <?php echo $total_quantity; ?></p>
                <p><strong>Total Value:</strong> Rs. <?php echo number_format($total_value, 2); ?></p>
                <a href="export_inventory_csv.php" class="btn btn-success mt-3">Export Report as CSV</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Current Inventory</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result_items->num_rows > 0): ?>
                            <?php while ($row = $result_items->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($row['price']); ?></td>

                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No items found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>