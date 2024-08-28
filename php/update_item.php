<?php

session_start(); // Start the session

if (!isset($_SESSION["id"]) || $_SESSION["id"] !== "logg") {
    header('Location: login.php');
    exit();
}
// Include database connection
include 'db_connect.php';

// Get item ID from URL
$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch item details from the database
$sql = "SELECT * FROM item WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $item = $result->fetch_assoc();
} else {
    echo "<p>Item not found.</p>";
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="bg-primary text-white py-3" style = "background-color: #062e48 !important">
        <div class="container d-flex align-items-center">
            <a href="dd.php" class="btn btn-light">Dashboard</a>
            <h1 class="m-0 flex-grow-1 text-center">Update Item</h1>
        </div>
    </header>

    <div class="container mt-5">
        <form action="process_update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <div class="form-group">
                <label for="itemName">Item Name</label>
                <input type="text" class="form-control" id="itemName" name="item_name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="Laptop" <?php if ($item['category'] == 'Laptop') echo 'selected'; ?>>Laptop</option>
                    <option value="Mobile" <?php if ($item['category'] == 'Mobile') echo 'selected'; ?>>Mobile</option>
                    <option value="PC" <?php if ($item['category'] == 'PC') echo 'selected'; ?>>PC</option>
                    <option value="Printer" <?php if ($item['category'] == 'Printer') echo 'selected'; ?>>Printer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Item</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>