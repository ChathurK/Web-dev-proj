<?php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION["id"]) || $_SESSION["id"] !== "logg") {
    header('Location: login.php');
    exit();
}



// Include database connection
include 'db_connect.php';

// Fetch all items from the database
$sql = "SELECT * FROM item";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                // Redirect to the PHP file to handle deletion
                window.location.href = 'delete_item.php?id=' + id;
            }
        }
    </script>
</head>

<body>
    <header class="bg-primary text-white py-3" style = "background-color: #062e48 !important">
        <div class="container d-flex align-items-center">
            <a href="dd.php" class="btn btn-light">Dashboard</a>
            <h1 class="m-0 flex-grow-1 text-center">Inventory Management</h1>
        </div>
    </header>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Inventory Items</h2>
            <div>
                <a href="add_item.php" class="btn btn-success mr-2">Add New Item</a>
                <a href="inventory_report.php" class="btn btn-info">View Inventory Report</a>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td>
                                <a href="update_item.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                            </td>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>