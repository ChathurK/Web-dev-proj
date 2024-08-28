<?php
    session_start(); // Start the session

    // Check if the user is logged in
    if (!isset($_SESSION["id"]) || $_SESSION["id"] !== "logg") {
        header('Location: login.php');
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex align-items-center">
            <a href="dd.php" class="btn btn-light">Dashboard</a>
            <h1 class="m-0 flex-grow-1 text-center">Add New Item</h1>
        </div>
    </header>

    <div class="container mt-5">
        <form action="process_add.php" method="post">
            <input type = "hidden" name="csrf_token">
            
                <label for="itemName">Item Name</label>
                <input type="text" class="form-control" id="itemName" name="item_name" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="Laptop">Laptop</option>
                    <option value="Mobile">Mobile</option>
                    <option value="PC">PC</option>
                    <option value="Printer">Printer</option>
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